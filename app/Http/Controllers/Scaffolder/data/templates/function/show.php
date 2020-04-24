public function show($id)
{
$item = self::$modelName::findOrFail($id);
return view('admin.$modelTable.show', compact('item'));
}
