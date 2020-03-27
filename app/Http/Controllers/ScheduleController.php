<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends GetFeegowContent
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sources = $this->getApiContent('http://clinic5.feegow.com.br/components/public/api/patient/list-sources');
        return view('schedule',['request' =>  $request, 'sources' => $sources]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strlen($request->inputName) <= 5){
            return  ['success' => false, 'message' => 'Informe o nome completo.'];
        }
        if($request->lstSources == '0'){
            return  ['success' => false, 'message' => 'Informe como conheceu.'];
        }

        if(strlen($request->inputBirth) != 10){
            return  ['success' => false, 'message' => 'Informe a data de aniversário.'];
        }

        $cpfSemPontos = str_replace(['.','-'], '', $request->inputCPF);
        if(strlen($cpfSemPontos) !== 11){
            return  ['success' => false, 'message' => 'CPF inválido'];
        }

        $ScheduleDate = $request->inputDate . ' ' . $request->lstHoharios . ':00';
        if(strlen($ScheduleDate) != 19){
            return  ['success' => false, 'message' => 'Informe data e hora para agendamento.'];
        }


        //Criando uma regra de negócio (não solicitada)
        //somente 1 atendimento por profissional de determinada especialidade
        $dupCliProWhere = ['cpf' => $cpfSemPontos, 'professional_id' => $request->idPro, 'specialty_id' => $request->idSpec];
        //somente 1 atendimento por determinada especialidade
        $dupCliProWhere = ['cpf' => $cpfSemPontos, 'specialty_id' => $request->idSpec];
        $alreadyExists = Schedule::where($dupCliProWhere)->exists();
        if ($alreadyExists) {
            return ['success' => false, 'message' => 'CPF já cadastrado para essa especialidade'];
        }
        else
        {
            $ScheduleDate = $request->inputDate . ' ' . $request->lstHoharios . ':00';
            //dd($request->idSpec . ', ' . $request->idPro . ', ' . $request->inputName . ', ' . $cpfSemPontos . ', ' . $request->lstSources . ', ' . $request->inputBirth . ', ' . $ScheduleDate);
            $schedule = new Schedule([
                'specialty_id' => $request->idSpec,
                'professional_id' => $request->idPro,
                'name' => $request->inputName,
                'cpf' => $cpfSemPontos,
                'source_id' => $request->lstSources,
                'birthdate' => $request->inputBirth,
                'date_time' => $ScheduleDate
            ]);

            if ($schedule->save()) {
                return ['success' => true, 'message' => 'Agendamento concluido com sucesso.'];
            } else {
                return ['success' => false ,'message' => 'Falha, verifique seus dados. Agendamento não cadastrado.'];
            }
        }
    }

}
