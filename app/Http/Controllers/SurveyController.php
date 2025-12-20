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
        $bitmask = 0;
        $data = array();

        foreach ($post_var as $key => $value) {
            if(is_array($value))
                $bitmask = array_sum($value);
            else
                $data[$key] = $value;
        }
        $data['setA'] = $bitmask;

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
        $data = array();
        $bitmask = 0;

        foreach ($post_var as $key => $value) {
            if(is_array($value))
                $bitmask = array_sum($value);
            else
                $data[$key] = $value;
        }
        $data['setA'] = $bitmask;

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
