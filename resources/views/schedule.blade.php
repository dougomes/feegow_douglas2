@extends('frmglobal')

@section('particular')
    <form id="frmAgendar" id="frmSchedule" name="frmSchedule" method="get">
        <div class="form-row">
            <div class="form-group">
                <label><h4>{{$request->inputProfessionalName}} - {{$request->inputSpecialtyName}}<h4></label>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label><h5>Preencha seus dados</h5></label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Nome</label>
                <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nome completo">
            </div>
            <div class="form-group col-md-6">
                <label for="lstSources">Como conheceu?</label>
                <select id="lstSources" name="lstSources" class="form-control">
                            <option value="0" selected>Como conheceu?</option>
                        @foreach($sources as $sourc)
                            <option value="{{ $sourc->origem_id }}">{{ $sourc->nome_origem }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputBirth">Data de nascimento</label>
                <input type="date" class="form-control" id="inputBirth" name="inputBirth" placeholder="Nascimento">
            </div>
            <div class="form-group col-md-6">
                <label for="inputCPF">CPF</label>
                <input type="text" class="form-control" id="inputCPF" name="inputCPF" placeholder="CPF">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputDate">Data de agendamento</label>
                <input type="date" class="form-control" id="inputDate" name="inputDate" placeholder="Data desejada">
            </div>
            <div class="form-group col-md-6">
                <label for="lstHoharios">Horário</label>
                <select id="lstHoharios" name="lstHoharios" class="form-control">
                    <option value="0" selected>Horário</option>
                    @for ($i = 10; $i < 19; $i++)
                        <option value="{{ (string)$i . ':00' }}">{{ (string)$i . ':00' }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <input type="hidden" name="idPro" id="idPro" value="{{ $request->inputProfessionalId }}">
        <input type="hidden" name="idSpec" id="idSpec" value="{{ $request->lstSpecialtyes }}">
        <button type="submit" class="btn btn-primary" onclick="messageBoxClear();this.enabled=false;">ENVIAR</button>
    </form>

    <div class="alert alert-danger d-none messageBox" id="divMessageBox" role="alert">
    </div>
@endsection

@section('appBusScripts')
    <script type="text/javascript">
        $(function(){
            $('form[name="frmSchedule"]').submit(function(event){
                    event.preventDefault();
                    $.ajax({
                            url: "{{ route('Schedule.Do') }}",
                            type: "get",
                            data: $(this).serialize(),
                            success: function(response) {
                                if(response.success == true) {
                                    alert('Agendamento cadastrado dom sucesso!');
                                    window.location.href = " {{ route('home') }} ";
                                } else {
                                    messageBox(response.message);
                                }
                            }
                        }
                    )
                }
            )
        });

        function messageBox($msg){
            $('#divMessageBox').removeClass('d-none').html($msg);


        }
        function messageBoxClear(){
            $('#divMessageBox').addClass('d-none').hmtl('');
        }
    </script>
@endsection
