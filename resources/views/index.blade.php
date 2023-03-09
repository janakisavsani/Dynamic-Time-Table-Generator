<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dynamic Time-Table Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <h1>Dynamic Time-Table Generator</h1>
    <form action="{{route('subjects')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="days">No of Working days:</label>
            <input type="number" class="form-control" name="days" id="days" value="{{ isset($days) ? implode(',', $days) : '' }}" min="1" max="7" placeholder="Enter number of days" required>
            <span class="text-danger" id="errdays"></span>
        </div>
        <div class="form-group">
            <label for="subjectsPerDay">No of Subjects per day:</label>
            <input type="number" class="form-control" name="subjectsPerDay" id="subjectsPerDay" value="{{ isset($subjectsPerDay) ? implode(',', $subjectsPerDay) : '' }}" min="1" max="8" placeholder="Enter number of subjects per day" required>
            <span class="text-danger" id="errsubjectsPerDay"></span>
        </div>
        <div class="form-group">
            <label for="totalSubjects">Total Subjects:</label>
            <input type="number" class="form-control" name="totalSubjects" id="totalSubjects" value="{{ isset($totalSubjects) ? implode(',', $totalSubjects) : '' }}" min="1" placeholder="Enter total number of subjects" required>
            <span class="text-danger" id="errtotalSubjects"></span>
        </div>
        <div class="form-group">
            <label>Total hours for week:</label>
            <span id="totalHours"></span>
        </div>
        <button type="submit" class="btn btn-primary">Generate Time-Table</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        var workingDaysInput,subjectsPerDayInput,totalSubjectsInput;

        $("#days").on('change', function(){
            workingDaysInput = $('#days').val() ;
            $("#errdays").html("");
            if(workingDaysInput <= 0){
                $('#days').val(1);
            }
            if(workingDaysInput > 7){
                $('#days').val(7);
            }
            updateTotalHours();
        });
        $("#subjectsPerDay").on('change', function(){
            subjectsPerDayInput = $('#subjectsPerDay').val() ;
            if(subjectsPerDayInput <= 0){
                $('#subjectsPerDay').val(1) ;
            }
            if(subjectsPerDayInput > 8){
                $('#subjectsPerDay').val(8) ;
            }
            updateTotalHours();
        });
        $("#totalSubjects").on('change', function(){
            totalSubjectsInput= $('#totalSubjects').val() ;
            if(totalSubjectsInput <= 0){
                $('#totalSubjects').val(1);
            }
                updateTotalHours();
        });
        function updateTotalHours() {
            workingDaysInput = $('#days').val() ;
            subjectsPerDayInput = $('#subjectsPerDay').val() ;
            totalSubjectsInput= $('#totalSubjects').val() ;
            if(!isNaN(workingDaysInput) && !isNaN(subjectsPerDayInput) && !isNaN(totalSubjectsInput) ){
                const totalHours = workingDaysInput * subjectsPerDayInput;
                $("#totalHours").html(totalHours);
            }
        }
  </script>
</body>
</html>