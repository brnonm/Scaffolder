public function destroy($model)
{
$model=self::$model::findOrFail($model);   $model->delete();
return redirect()->route('$modelTable.index');
}
