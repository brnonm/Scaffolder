public
function create()
{
$item = new self::$modelName();
return view('admin.$modelTable.create', compact('item'));
}

public
function store()
{

}
