@extends('layouts.app')

@section('content')


<div class="container">

   <form action="">

    <table>
        <select >
            @foreach ($send as $id)
            <option>
                {{$id['city_name']}}
            </option>
                
            @endforeach
        </select>
    </table>
   </form>
</div>
@endsection
