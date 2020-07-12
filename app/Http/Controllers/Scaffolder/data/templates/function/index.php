
    public function index(){
        $items = self::$model::paginate(15);
        return view('admin.$modelTable.index', compact('items'));
    }

