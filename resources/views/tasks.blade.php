@extends('layouts.app')

@section('content')
    <!-- Bootstrap 模版... -->

    <div class="panel-body">
        <!-- 显示验证错误 -->
        @include('common.errors')
		@if (count($tasks) > 0)
	        <div class="panel panel-default">
	            <div class="panel-heading">
	               目前任务
	            </div>
	
	            <div class="panel-body">
	                <table class="table table-striped task-table">
	
	                    <!-- 表头 -->
	                    <thead>
	                        <th>Task</th>
	                        <th>&nbsp;</th>
	                    </thead>
	
	                    <!-- 表身 -->
	                    <tbody>
	                        @foreach ($tasks as $task)
	                            <tr>
	                                <!-- 任务名称 -->
	                                <td class="table-text">
	                                    <div>{{ $task->name }}</div>
	                                </td>
	
    								<!-- 删除按钮 -->
    								<td class="table-text">
    								    <form action="/task/{{ $task->id }}" method="POST">
    								        {{ csrf_field() }}
    								        {{ method_field('DELETE') }}
								
    								        <button>删除任务</button>
    								    </form>
	                                </td>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    @endif
        <!-- 新任务的表单 -->
        <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- 任务名称 -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">任务</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- 增加任务按钮-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> 增加任务
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection