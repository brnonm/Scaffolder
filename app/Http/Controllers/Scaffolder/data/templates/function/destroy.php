public function destroy($model)
{
$model=self::$modelName::findOrFail($model);   $model->delete();
return redirect()->route('$modelTable.index');
}
