@extends('admin::layouts.gentelella')

{{--@section('title', 'Participants')--}}

@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Tables <small>Some examples to get you started</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <a class="btn btn-xs btn-success pull-right"><i class="fa fa-plus-square"></i> New</a>
                    <a class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus-square"></i> </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Stripped table <small>Stripped table subtitle</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    @foreach($fields as $fieldName => $fieldData)
                                        <th>{{ $fieldData->title }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                    @foreach($fields as $fieldName => $fieldData)
                                        <td>{{ $fieldData->type->list($item->$fieldName) }}</td>
                                    @endforeach
                                        <td>@mdo</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>
    </div>

@endsection