    public function create(){
        $item = new self::$model();
        return view('admin.$modelTable.create', compact('item'));
    }

    public function store($formRequest $request){
        self::$model::create($request->all());
        return redirect()->route('$modelTable.index');
    }
