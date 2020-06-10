    public function create(){
        $item = new self::$model();
        :$relationsGetData
        return view('admin.$modelTable.create', compact('item':$relationsCompact));
    }

    public function store($formRequest $request){
        self::$model::create($request->all());
        return redirect()->route('$modelTable.index');
    }
