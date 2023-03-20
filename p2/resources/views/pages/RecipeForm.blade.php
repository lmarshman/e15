@extends('layouts/main')

@section('title')
    Recipe Conversions
@endsection

@section('content')
    <h1 class='recipeh1'>Recipe Conversion Form</h1>
    <div class="container-fluid">
        <div class="p-5 mb-3 bg-light rounded col-md-11">
            <form method='GET' action='/recipe/process'>
                <!--Input for convert1 dropdown-->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label inputSpacing">Convert:</label>
                    <div class="col-sm-10 inputSpacing">
                        <select name="convert1" id="convert1" class="form-control">
                            <option></option>
                            <option value="tsp" {{ old('convert1') == 'tsp' ? 'selected' : '' }}>tsp</option>
                            <option value="tbs" {{ old('convert1') == 'tbs' ? 'selected' : '' }}>tbs</option>
                            <option value="oz" {{ old('convert1') == 'oz' ? 'selected' : '' }}>oz</option>
                            <option value="cup" {{ old('convert1') == 'cup' ? 'selected' : '' }}>cup</option>
                        </select>
                    </div>
                </div>
                <!--Input for convert2 dropdown-->
                <div class="row-mb-3">
                    <label class="col-sm-4 col-form-label">To:</label>
                    <div class="col-sm-10">
                        <select name="convert2" id="convert2" class="form-control">
                            <option></option>
                            <option value="tsp" {{ old('convert2') == 'tsp' ? 'selected' : '' }}>tsp</option>
                            <option value="tbs" {{ old('convert2') == 'tbs' ? 'selected' : '' }}>tbs</option>
                            <option value="oz" {{ old('convert2') == 'oz' ? 'selected' : '' }}>oz</option>
                            <option value="cup" {{ old('convert2') == 'cup' ? 'selected' : '' }}>cup</option>
                        </select>
                    </div>
                </div>
                <!--Input for Amount field-->
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label amountSpacing">Amount:</label>
                    <div class="col-sm-10 inputSpacing">
                        <input class="form-control" type="text" name="amount" id="amount"
                            value='{{ old('amount') }}'>
                    </div>
                </div>
                <!--Input for halve/double/triple radio buttons-->
                <div class="row mb-3">
                    <div class="formSpacing">
                        <label class="visually-hidden" for="autoSizingSelect">I want to:</label><br>
                        <input type="radio" id="halve" name="convertType" value='halve'
                            {{ old('convertType') == 'halve' ? 'checked' : '' }}>
                        <label for="html">Halve the Recipe</label><br>
                        <input type="radio" id="double" name="convertType" value="double"
                            {{ old('convertType') == 'double' ? 'checked' : '' }}>
                        <label for="html">Double the Recipe</label><br>
                        <input type="radio" id="triple" name="convertType" value="triple"
                            {{ old('convertType') == 'triple' ? 'checked' : '' }}>
                        <label for="html">Triple the Recipe</label><br>
                        </label>
                    </div>
                </div>
                <div class="row mb-3 inputSpacing">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <!--Displays form errors, if any-->
                @if (count($errors) > 0)
                    <ul class='alert alert-danger' style="list-style-type: none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </form>
        </div>
    </div>

    <!--Checks if Conversion variable is null. If yes, displays a basic statement to enter input
                to the form. Else, displays the form conversion.-->
    @if (is_null($conversion))
        <div class='conversion'>
            <h4>Enter input to see the conversion.</h4>
        </div>
    @else
        <div class='conversion'>
            <h4>The conversion is: {{ $conversion }} {{ old('convert2') }}</h4>
        </div>
    @endif

@endsection
