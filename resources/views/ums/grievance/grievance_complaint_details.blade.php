@extends('ums.admin.admin-meta')
@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f8f9fa;">
    <div class="col-md-8 bg-white p-4 shadow mt-4">
        <div class="panel panel-primary">
            @include('ums.admin.notifications')
            <div class="panel-heading text-center p-3">
                About DSMNRU Grievance Redressal And Management
            </div>
                    <div class="panel-body about-gcr">
                        <form method="post" action="" id="your-form">
                            @csrf
                            <div class="tab1">
                                <div class="chat-container p-3">
                                    <table>
                                        @foreach($data as $dataRow)
                                        <tr>
                                            <td>{{$dataRow->complaint}} ({{$dataRow->responder_type_text}}) &nbsp &nbsp
                                                &nbsp &nbsp{{$dataRow->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    <div class="row pt-1 rounded-3 " style="border: 1px solid #c0c0c0;height: 65px;">
                                        <div class="col-md-7" >
                                            <input name="complaint " id="message-input" class="form-control mt-0 " placeholder="Enter complaint" rows="2" >
                                        </div>
                                        <div class="col-md-5">
                                            <select name="status" class="form-control" >
                                                {{-- @foreach($data as $dataRow) --}}
                                                <option value="0" @if(isset($dataRow) && $dataRow->status == 0) selected @endif>Pending</option>
                                                <option value="1" @if(isset($dataRow) && $dataRow->status == 1) selected @endif>Under Process</option>
                                                <option value="2" @if(isset($dataRow) && $dataRow->status == 2) selected @endif>Closed</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <br>
                                            <button type="submit" class="btn-lg btn-success">Save</button>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function addMessage(message) {
        // Append the message to the chat container
        $('#chat-container').append('<div class="message sent">' + message + '</div>');

        // Scroll to the bottom of the chat container
        var chatContainer = $('#chat-container')[0];
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Example: Adding a new message (you should adapt this based on your actual use case)
    addMessage('This is a sample message.');

    // Example: Adding a new message when a form is submitted
    $('#your-form').submit(function(event) {
        event.preventDefault();  // Prevent the form from submitting the traditional way
        var message = $('#message-input').val();  // Get the message from the input field
        addMessage(message);  // Add the message to the chat container
        $('#message-input').val('');  // Clear the input field
    });
</script>

@endsection
