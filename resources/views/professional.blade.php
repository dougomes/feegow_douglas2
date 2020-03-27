
    <!-- Card deck -->
    <div class="card-deck">
        <h6 class="card-title" style="margin-left: 15px; margin-right: 15px;">{{ $NumEsps = count($response) }} especialista{{ $NumEsps != 1 ? 's' : '' }}</h6>
    </div>
    <div class="card-deck">
    @foreach($response as $register)
        <!-- Card -->
        <div class="card mb-4" style="min-width: 15rem; max-width: 16rem" >

            <!--Card image-->
            <div class="view overlay">
                <img class="card-img-top" src="{{ ($register->foto == '') ? asset('img/NoPhoto.jpg') : $register->foto }}"
                     alt="Card image cap">
                <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!--Card content-->
            <div class="card-body">
                <input type="hidden" name="cardSpecialtyName" id="cardProName" value="{{$register->nome}}">
                <input type="hidden" name="cardSpecialtyName" id="cardProId" value="{{$register->profissional_id}}">
                <!--Title-->
                <h4 class="card-title">{{$register->nome}}</h4>
                <!--Text-->
                <p class="card-text">{{$register->conselho}} - {{$register->documento_conselho}}.</p>
                <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                <button type="button" class="btn btn-primary" onClick="$('#inputProfessionalId').val('{{$register->profissional_id}}');$('#inputProfessionalName').val('{{$register->nome}}');$('#frmPreparaAgendamento').submit();">Agendar</button>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Card deck -->
