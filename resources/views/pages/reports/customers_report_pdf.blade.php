<head>
    <style>
        .table{
            width: 100%;
        }
        .table th{
            text-align: left;
        }
    </style>
</head>
<table class="table">
    <thead>
        <tr>
            <th>
                No.
            </th>
            <th style="width: 15%">
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Mobile No
            </th>
            <th>
                Adress
            </th>
            <th>
                Pincode
            </th>
            <th>
                City
            </th>
            <th>
                State
            </th>
        </tr>
    </thead>
    <tbody>
      @foreach($customersReports as $key=>$customersReport)
     <tr>
         <td>{{$key+1}}</td>
         <td>{{$customersReport->first_name}} {{$customersReport->last_name}}</td>
         <td>{{$customersReport->email}}</td>
         <td>{{$customersReport->mobile_no}}</td>
         <td>{{$customersReport->add}}</td>
         <td>{{$customersReport->pincode}}</td>
         <td>{{$customersReport->city}}</td>
         <td>{{$customersReport->state}}</td>
     </tr>
     @endforeach
    </tbody>
</table>