<p>Good day <b>{{$data['receiver'] }}</b>,</p>
<p>
    This is a reminder that your access to the research file will expire in 1 day. 
    Please ensure you review the necessary documents before your access ends.
</p>

    Here's the research that will expire your access in 1 day:
    <ul>
        @foreach($data['studentRequests'] as $request)
            <li>{{ $request['researchTitle'] }}</li>
        @endforeach
    </ul>

<p>Regards,</p>
<p style="font-style: italic">R&E-Services.</p>