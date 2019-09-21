@extends('admin.layouts.admin')

{{-- TODO cleanup this--}}

@push('styles')
    <style>
        body {
            overflow-x: hidden;
        }

        .dd-list .dd-list {
            padding-left: 3em;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
        }

        .dd-handle {
            display: block;
            margin: 0.5em 0;
            padding: 1em;
            box-sizing: border-box;
        }

        .dd-handle,
        .cursor-move {
            cursor: move;
        }

        .dd-handle:hover {
            color: #2ea8e5;
        }

        .dd-expand,
        .dd-nochildren .dd-placeholder,
        .dd-collapsed .dd-list,
        .dd-collapsed .dd-collapse {
            display: none;
        }

        .dd-collapsed .dd-expand {
            display: block;
        }

        .dd-empty,
        .dd-placeholder {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel > .dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" defer></script>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.dd').nestable({
                maxDepth: 2,
                expandBtnHTML: '',
                collapseBtnHTML: '',
                onDragStart: function () {
                    $('body').addClass('cursor-move');
                }, beforeDragStop: function () {
                    $('body').removeClass('cursor-move');
                }
            });

            function createAlert(color, message, dismiss) {
                const button = dismiss ? '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : '';

                $('#status-message').html('<div class="alert alert-' + color + ' alert-dismissible fade show" role="alert">' + message + button + '</div>');
            }

            function getCsrfToken() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            const saveBtn = $('#saveBtn');

            saveBtn.on('click', function () {
                saveBtn.attr('disabled', true);

                fetch('{{ route('admin.navbar-elements.update-order') }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        'order': $('.dd').nestable('serialize')
                    })
                }).then(function (response) {
                    return response.json();
                }).then(function (json) {
                    saveBtn.attr('disabled', false);
                    createAlert('success', json.message, true)
                }).catch(function (error) {
                    saveBtn.attr('disabled', false);
                    console.error(error);
                    createAlert('danger', 'Error: ' + error, true)
                });
            });


        });
    </script>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="dd" id="nestable">
                <ol class="dd-list list-unstyled">
                    @foreach($navbarElements as $navbarElement)
                        <li class="dd-item {{ $navbarElement->isDropdown() ? '' : 'dd-nochildren' }}" data-id="{{ $navbarElement->id }}">
                            <div class="dd-handle card card-body">
                                @if($navbarElement->isDropdown())
                                    <i class="fas fa-bars"></i>
                                @endif
                                {{ $navbarElement->name }}
                                <span class="float-right">
                                    <a href="{{ route('admin.navbar-elements.edit', $navbarElement) }}" class="m-1 dd-nodrag" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.navbar-elements.destroy', $navbarElement) }}" class="m-1 dd-nodrag" title="Delete" data-toggle="tooltip" data-confirm="delete"><i class="fas fa-trash"></i></a>
                                </span>
                            </div>
                            @if($navbarElement->isDropdown())
                                <ol class="dd-list list-unstyled">
                                    @foreach($navbarElement->elements as $childElement)
                                        <li class="dd-item dd-nochildren" data-id="{{ $childElement->id }}">
                                            <div class="dd-handle card card-body">
                                                {{ $childElement->name }}
                                                <span class="float-right">
                                                    <a href="{{ route('admin.navbar-elements.edit', $childElement) }}" class="m-1 dd-nodrag" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.navbar-elements.destroy', $childElement) }}" class="m-1 dd-nodrag" title="Delete" data-toggle="tooltip" data-confirm="delete"><i class="fas fa-trash"></i></a>
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>

            <button type="button" class="btn btn-success" id="saveBtn">
                <i class="fas fa-save"></i> Save
            </button>
            <a class="btn btn-primary" href="{{ route('admin.navbar-elements.create') }}"><i class="fas fa-plus"></i> Create</a>
        </div>
    </div>
@endsection