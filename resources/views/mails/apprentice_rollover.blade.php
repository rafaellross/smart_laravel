Hello,
<p>The following employees will have their apprenticeship rollover this week:</p>
<ul class="list-group">
  @foreach ($employees as $employee)

    <li class="list-group-item">
      {{$employee->name}}
      <ul>
        <li>Apprenticeship Rollover Date: {{\Carbon\Carbon::parse($employee->anniversary_dt)->format('d/m/Y')}}</li>
        <li>Current Year Apprenticeship: {{$employee->apprentice_year}}</li>
      </ul>
    </li>

  @endforeach

</ul>

Thank You
<br/>
