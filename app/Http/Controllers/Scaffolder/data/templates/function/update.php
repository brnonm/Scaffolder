public function edit($id)
{
$item = self::$modelName::findOrFail($id);
return view('admin.$modelTable.update', compact('item'));
}

public function update($id, Request $request)
{
$item = self::$modelName::findOrFail($id);
$item->update($request->all());
return redirect()->route('$modelTable.index');
}
