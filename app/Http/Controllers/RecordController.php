<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected $rules = [
        'explanation' => 'required|min:5|max:256|regex:/^[a-z0-9_\s,\.\'-\/\:]+$/i',
        'made_at' => 'required|date:YYYY/mm/dd',
        'value_at' => 'date:YYYY/mm/dd',
        'method_id' => 'required|exists:methods,id',
        'concept_id' => 'required|exists:concepts,id',
        'value' => 'required|numeric',
    ];

    protected $pageSize = 50;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records= Record::orderBy('made_at','desc')->paginate($this->pageSize);
        return view('record.index', ['records' => $records, 'view' => 'method'])
            ->with('i', ($request->input('page', 1) - 1) * $this->pageSize);
    }

    public function indexMethod($method_id,Request $request)
    {
        $page = $request->input('page', 1);
        $records= Record::where('method_id', $method_id)->orderBy('made_at','asc')->paginate($this->pageSize);
        $balance = 0.0;
        $cnt = (($page - 1) * $this->pageSize);
        if ($page>1){
            $results = DB::select('select value from records where method_id = :method_id order by made_at asc limit :cnt', ['method_id' => $method, 'cnt'=> $cnt]);
            foreach ($results as $result){
                $balance+=$result->value;
            }
        }
        return view('record.index', ['records' => $records, 'view' => 'method'])
            ->with('i', $cnt)
            ->with('balance', $balance);
    }

    public function indexConcept($concept,Request $request)
    {
        $records= Record::where('concept_id', $concept)->orderBy('made_at','desc')->paginate($this->pageSize);
        return view('record.index', ['records' => $records, 'view' => 'concept'])
            ->with('i', ($request->input('page', 1) - 1) * $this->pageSize);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
