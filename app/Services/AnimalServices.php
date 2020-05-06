<?php

namespace App\Services;
//use http\Env\Request;
use App\Http\Requests\CioRequest;
use App\Models\Animal;
use App\Models\AnimalHeat;
use App\Repositories\CioRepository;
use App\Enums\AnimalHeatStatusEnum;
use DateTime;

class AnimalServices
{
    public function dateHandling($data)
    {
        $format = new DateTime();
        $data['date_animal_heat'] = $format->format('Y-m-d H:i:s');
        $data['date_coverage'] = $format->format('Y-m-d H:i:s');

        return $data;
    }

    public function animal_id($request, $data)
    {
        $data['animal_id'] = (int)$data['animal_id'];
        return $data;
    }

    public function managementFather($request, $data)
    {
        if (isset($request->father_id) && (isset($request->father_name))) {
            $data['father'] = $request->father_id . '-' . $request->father_name;
            $data['father_id'] = null;
            $data['father_name'] = null;
        } elseif (isset($request->father)) {
            $request->father_id = null;
            $request->father_name = null;
            $data['father'] = $request->father;
        }
        return $data;
    }

    public function status($request, $data)
    {
        $status = 'pending';
        $data['status'] = $status;
        return $data;
    }

    public function birthPrediction($data)
    {
        $partoPrevisto = date('Y-m-d H:m:s', strtotime('+280 days', strtotime($data['date_coverage'])));
        $data['date_childbirth_foreseen'] = $partoPrevisto;
        return $data;
    }

    public function partoSucesso($request, $data)
    {
        if ($data['status'] == 'success') {
            redirect()->route('animals.create');
        }
        return $data;
    }

    public function create_by($request, $data)
    {
        $data = AnimalRepository::created_by($data);
        return $data;
    }
}