    public function edit($id){
        $item = self::$model::findOrFail($id);
        return view('admin.$modelTable.update', compact('item'));
    }

    public function update($id, $formRequest $request){
        $item = self::$model::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('$modelTable.index');
    }
