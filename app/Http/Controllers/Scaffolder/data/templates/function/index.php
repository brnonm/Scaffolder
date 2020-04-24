public
function index()
{
$items = self::$modelName::all();
return view('admin.$modelTable.index', compact('items'));
}

