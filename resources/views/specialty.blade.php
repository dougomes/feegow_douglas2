@extends('frmglobal')

@section('particular')
    <nav class="navbar navbar-dark bg-primary">
        <label class="navbar-brand">Feegow - Agendamento</label>
        <form class="form-inline" id="frmPreparaAgendamento" name="frmPreparaAgendamento" enctype="multipart/form-data" method="post" action="{{route('Schedule.Form')}}">
            @csrf
            <input type="hidden" name="inputSpecialtyName" id="inputSpecialtyName" value="">
            <input type="hidden" name="inputProfessionalId" id="inputProfessionalId" value="">
            <input type="hidden" name="inputProfessionalName" id="inputProfessionalName" value="">

            <select name="lstSpecialtyes" id="lstSpecialtyes" class="form-control" onchange="if(this.value != 0){listaMedicosPorEsp();}else{limpaScenario();}">
                <option value="0">Selecione a especialidade
                @foreach($response as $resp)
                    <option value="{{ $resp->especialidade_id }}">{{ $resp->nome }}</option>
                @endforeach
            </select>
            </form>
    </nav>

    <div id="divProfessionals">
    </div>
@endsection

@section('appBusScripts')
    <script type="text/javascript">
        function listaMedicosPorEsp() {
            limpaScenario();
            <!--$('#lstSpecialtyes').selectedIndex) e $('#lstSpecialtyes').options[var].text retornam undefined-->
            $('#inputSpecialtyName').val(document.getElementById('lstSpecialtyes').options[document.getElementById('lstSpecialtyes').selectedIndex].text);
            $.ajax({
                url: "{{ route('ProfBySpec', ['']) }}" + "/" + $('#lstSpecialtyes').val().toString(),
                type: "get",
                success: function (htmResponse) {
                    $('#divProfessionals').html(htmResponse);
                }
            });
        };

        function limpaScenario(){
            $('#divProfessionals').html('');
            $('#inputSpecialtyName').val('');
            $('#inputProfessionalId').val('');
            $('#inputProfessionalName').val('');
        }
    </script>
@endsection
