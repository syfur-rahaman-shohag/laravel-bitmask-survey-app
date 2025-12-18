<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Storage;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $json_file_name = "survey_form.json";
        $json_set = Storage::disk('local')->get($json_file_name);
        $set = json_decode($json_set, false);

        /* Get the survey data only for Male */
        //$surveys = Survey::Male()->get();

        /* Get the survey data only for Male */
        //$surveys = Survey::Female()->get();

        $surveys = Survey::latest()->get();
        return view('surveys.index', compact('surveys', 'set'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $json_file_name = "survey_form.json";
        $json_set = Storage::disk('local')->get($json_file_name);
        $set = json_decode($json_set, false);

        $data = array(
            'set' => $set
        );

        return view('surveys.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $post_var = (object) $request->post();
        $sum_of_set = 0;
        $question_set = 'A';
        $data = array();

        foreach ($post_var as $key => $value) {
            if (preg_match('/^'.$question_set.'\d+$/', $key)) {
                if(is_array($value))
                    $arr_sum = array_sum($value);
                else
                    $arr_sum = $value;
                $sum_of_set += $arr_sum;
            }else{
                $data[$key] = $value;
            }
        }

        $data['setA'] = $sum_of_set;

        Survey::create($data);

        return redirect()->route('surveys.index')
            ->with('success', 'Survey created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        $json_file_name = "survey_form.json";
        $json_set = Storage::disk('local')->get($json_file_name);
        $set = json_decode($json_set, false);

        $data = array(
            'set' => $set,
            'survey' => $survey
        );

        return view('surveys.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $post_var = (object) $request->post();
        $sum_of_set = 0;
        $question_set = 'A';
        $data = array();

        foreach ($post_var as $key => $value) {
            if (preg_match('/^'.$question_set.'\d+$/', $key)) {
                if(is_array($value))
                    $arr_sum = array_sum($value);
                else
                    $arr_sum = $value;
                $sum_of_set += $arr_sum;
            }else{
                $data[$key] = $value;
            }
        }

        $data['setA'] = $sum_of_set;

        //print_r($data);
        //die();

        $survey->update($data);

        return redirect()->route('surveys.index')
            ->with('success', 'Survey updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()->route('surveys.index')
            ->with('success', 'Survey deleted successfully');
    }
}
