public function show($id)
{
$item = self::$model::findOrFail($id);
return view('admin.$modelTable.show', compact('item'));
}
