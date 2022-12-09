<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Library
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mt-2 py-6">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    {{-- <h2>Company CRUD</h2> --}}
                                </div>
                                <div class="pull-right mb-2">
                                    <a class="btn btn-outline-primary" href="{{ route('issue_models.create') }}"> Issue</a>
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            @php alert()->success('Success', $message); @endphp
                        @endif
                        @if ($message = Session::get('info'))
                            @php alert()->info('Update', $message); @endphp
                        @endif

                        @if ($message = Session::get('delete'))
                            @php toast($message, 'info'); @endphp
                        @endif
                        <table class="table table-striped table-light">
                            <tr>
                                <th>Issue.No</th>
                                <th>Patron</th>
                                <th>Book Title</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th class="text-center" width="280px">Action</th>
                            </tr>
                            @foreach ($issue_models as  $issue_model)
                                <tr>
                                    <td>{{  $issue_model->id }}</td>
                                    <td>{{  $issue_model->patron }}</td>
                                    <td>{{ Str::limit( $issue_model->book_title, '10') }}</td>
                                    <td>{{ Str::limit( $issue_model->issue_date, '20') }}</td>
                                    <td>{{ Str::limit( $issue_model->return_date, '20') }}</td>
                                    <td>{{ Str::limit( $issue_model->status, '20') }}</td>
                                    <td>
                                        <form action="{{ route('issue_models.destroy',  $issue_model->id) }}" method="Post">
                                            <a class="btn btn-outline-success"
                                                href="{{ route('issue_models.show',  $issue_model->id) }}">Show</a>
                                            <a class="btn btn-outline-info"
                                                href="{{ route('issue_models.edit',  $issue_model->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $issue_models->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
