public
function index()
{
$items = self::$model::all();
return view('admin.$modelTable.index', compact('items'));
}

