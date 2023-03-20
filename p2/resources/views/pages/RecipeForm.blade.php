@extends('layouts/main')

@section('title')
    Recipe Conversions
@endsection

@section('content')
    <h1 class='recipeh1'>Recipe Conversion Form</h1>
    <div class="container-fluid">
        <div class="p-5 mb-3 bg-light rounded col-md-11">
            <form method='GET' action='/recipe'>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label inputSpacing">Convert:</label>
                    <div class="col-sm-10 inputSpacing">
                        <select name="convert1" id="convert1" class="form-control">
                            <option value="none" {{ old('convert1') == 'convert1' ? 'selected' : '' }}></option>
                            <option value="tsp">tsp</option>
                            <option value="tbs">tbs</option>
                            <option value="oz">oz</option>
                            <option value="cup">cup</option>
                        </select>
                    </div>
                </div>
                <div class="row-mb-3">
                    <label class="col-sm-4 col-form-label">To:</label>
                    <div class="col-sm-10">
                        <select name="convert2" id="convert2" class="form-control">
                            <option value="none" {{ old('convert1') == 'convert1' ? 'selected' : '' }}></option>
                            <option value="tsp">tsp</option>
                            <option value="tbs">tbs</option>
                            <option value="oz">oz</option>
                            <option value="cup">cup</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label amountSpacing">Amount:</label>
                    <div class="col-sm-10 inputSpacing">
                        <input class="form-control" type="text" name="amount" id="amount"
                            value='{{ old('amount') }}'>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="formSpacing">
                        <label class="visually-hidden" for="autoSizingSelect">I want to:</label><br>
                        <input type="radio" id="halve" name="convertType" value="halve" value='halve'
                            {{ old('convertType') == 'halve' ? 'checked' : '' }}>
                        <label for="html">Halve the Recipe</label><br>
                        <input type="radio" id="double" name="convertType" value="double">
                        <label for="html">Double the Recipe</label><br>
                        <input type="radio" id="triple" name="convertType" value="triple">
                        <label for="html">Triple the Recipe</label><br>
                        </label>
                    </div>
                </div>
                <div class="row mb-3 inputSpacing">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                @if (count($errors) > 0)
                    <ul class='alert alert-danger'>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>
        </div>
    </div>

    @if (is_null($convert1))
        <div class='conversion'>
            <h4>Enter input to see the conversion.</h4>
        </div>
    @else
        <div class='conversion'>
            <h4>The conversion is: {{ $conversion }} {{ $convert2 }}</h4>
        </div>
    @endif


@endsection
