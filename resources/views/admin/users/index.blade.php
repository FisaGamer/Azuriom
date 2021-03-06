@extends('admin.layouts.admin')

@section('title', trans('admin.users.title'))

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('auth.name') }}</th>
                        <th scope="col">{{ trans('auth.email') }}</th>
                        <th scope="col">{{ trans('messages.fields.role') }}</th>
                        <th scope="col">{{ trans('messages.fields.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <th scope="row">
                                {{ $user->id }}

                                @if($user->is_deleted)
                                    <i class="fas fa-user-slash text-dark" title="{{ trans('admin.users.info.deleted') }}" data-toggle="tooltip"></i>
                                @elseif($user->isAdmin())
                                    <i class="fas fa-crown text-warning" title="{{ trans('admin.users.info.admin') }}" data-toggle="tooltip"></i>
                                @endif
                                @if($user->is_banned)
                                    <i class="fas fa-ban text-danger" title="{{ trans('admin.users.info.banned') }}" data-toggle="tooltip"></i>
                                @endif
                            </th>
                            <td @if($user->is_deleted) class="text-strikethrough" @endif>{{ $user->name }}</td>
                            <td @if($user->is_deleted) class="text-strikethrough" @endif>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-label" style="{{ $user->role->getBadgeStyle() }}">{{ $user->role->name }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="mx-1" title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            {{ $users->links() }}

            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
            </a>
        </div>
    </div>
@endsection
