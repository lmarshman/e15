@extends('layouts/main')

@section('title')
    Recipe Conversions
@endsection

@section('content')
    <h1>Recipe Conversion Form</h1>
    <div class="container-fluid">
        <div class="p-5 mb-3 bg-light rounded col-md-11">
            <form>
                @csrf
                <div class="row mb-3">
                    <label class="visually-hidden" for="autoSizingInput">Convert:</label>
                    <select name="convert1" id="convert1">
                        <option value="none"></option>
                        <option value="tsp">tsp</option>
                        <option value="tbs">tbs</option>
                        <option value="oz">oz</option>
                        <option value="cup">cup</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <label class="visually-hidden" for="autoSizingInputGroup">To:</label>
                    <div class="input-group">
                        <select name="convert2" id="convert2">
                            <option value="none"></option>
                            <option value="tsp">tsp</option>
                            <option value="tbs">tbs</option>
                            <option value="oz">oz</option>
                            <option value="cup">cup</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="visually-hidden" for="autoSizingSelect">Amount:</label>
                    <input class="form-control" type="text" name="amount" id="amount">
                </div>
                <div class="row mb-3">
                    <div>
                        <label class="visually-hidden" for="autoSizingSelect">I want to:</label><br>
                        <input type="radio" id="halve" name="halve" value="halve">
                        <label for="html">Halve the Recipe</label><br>
                        <input type="radio" id="double" name="double" value="double">
                        <label for="html">Double the Recipe</label><br>
                        <input type="radio" id="triple" name="triple" value="triple">
                        <label for="html">Triple the Recipe</label><br>
                        </label>
                    </div>
                </div>
                <div class="row mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
