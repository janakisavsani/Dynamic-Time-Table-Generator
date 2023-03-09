<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Subject Hours</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

<form id="target">
    <div class="form-group">
        <label for="task" class="col-sm-1 control-label">Enter subject name & hours</label>
            @for ($i = 1; $i <= $totalSubjects; $i++)
            <div class="col-sm-12">
                <span>Subject{{$i}}</span>
                <input type="text" name="subject[{{ $i }}]" id="subject[{{ $i }}]" class="form-control" placeholder="Enter Subject Name">
                <input type="number" class="form-control" name="hour[{{$i}}]" placeholder="Enter Hours" min="1" required>
            </div>
            @endfor
        </div>
     <input type="hidden" name="subjectsPerDay" value="{{$subjectsPerDay}}">
     <input type="hidden" name="workingDays" value="{{$days}}">
     @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="submit" id="other">Submit</button>

    <div id="tableData">

    </div>
</form>

</body>

<script type="text/javascript">

$("#target").submit(function( event ) {
    event.preventDefault();
    var x = 5;
    var y = 5;
    if (x != y) {
        alert("not ");
    } else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ route('test') }}",
            type : 'POST',
            data : $(this).serialize(),
            success : function(data) {              
                if (data.status == 'error') {
                    alert(data.message);
                }else{
                    console.log(data)
                    $('#tableData').html(data.table);
                }
            },
            error : function(request,error)
            {
                alert("Request: "+JSON.stringify(request));
            }
        });
    }
});

</script

</html>
