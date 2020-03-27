<?php

namespace App\Http\Controllers;


class SpecialtyController extends GetFeegowContent
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->getApiContent('https://api.feegow.com.br/api/specialties/list');
        if($response) {
            return view('specialty',['response' => $response]);
        }
    }

    public function listProfessionals($specialty_id)
    {
        //Não faz sentido listar médicos inatrivos para agendamento
        $response = $this->getApiContent('https://api.feegow.com.br/api/professional/list?ativo=1&especialidade_id=' . $specialty_id);
        if($response) {
            //return $response;
            return view('professional',['response' => $response]);
        }
    }

    /*
     * Retorna HTML com um bootstrap card para cada médico encontrado
     */
    public function listProfessionalsViewBootstrap($specialty_id)
    {
        echo('Specialty id = ' . $specialty_id . '<br><br><br>');
        //Não faz sentido agendar médicos inatrivos
        $professionals = $this->listProfessionals($specialty_id);
        if($professionals) {
            foreach ($professionals as $prof) {
                echo('<a href="ddddd.com/index.php?d=' . $prof->profissional_id . '">' . $prof->nome .'</a><br>');
            }
        }
    }


}
