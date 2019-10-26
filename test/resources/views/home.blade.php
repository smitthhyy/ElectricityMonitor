@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h3>{!! $chart1->options['chart_title'] !!}</h3>
                            {!! $chart1->renderHtml() !!}
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings2['total_number']) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings3['column_class'] }}">
                            <h3>{{ $settings3['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings3['fields'] as $field)
                                            <th>
                                                {{ ucfirst($field) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings3['data'] as $row)
                                        <tr>
                                            @foreach($settings3['fields'] as $field)
                                                <td>
                                                    {{ $row->{$field} }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings3['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $chart4->options['column_class'] }}">
                            <h3>{!! $chart4->options['chart_title'] !!}</h3>
                            {!! $chart4->renderHtml() !!}
                        </div>
                        <div class="{{ $chart5->options['column_class'] }}">
                            <h3>{!! $chart5->options['chart_title'] !!}</h3>
                            {!! $chart5->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings6['column_class'] }}">
                            <h3>{{ $settings6['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings6['fields'] as $field)
                                            <th>
                                                {{ ucfirst($field) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings6['data'] as $row)
                                        <tr>
                                            @foreach($settings6['fields'] as $field)
                                                <td>
                                                    {{ $row->{$field} }}
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings6['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="{{ $chart7->options['column_class'] }}">
                            <h3>{!! $chart7->options['chart_title'] !!}</h3>
                            {!! $chart7->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart4->renderJs() !!}{!! $chart5->renderJs() !!}{!! $chart7->renderJs() !!}
@endsection