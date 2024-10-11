

@extends('layouts.sidebar')

@section('title', 'ประวัติการจองที่จอดรถ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('user-reservation.css') }}">
@endpush

@section('content')
    <div class="container">
        <!-- แสดงการจองล่าสุด -->
        @if ($latestReservation)
            <div class="latest-reservation">
                <h2>การจองล่าสุด</h2>
                <table>
                    <tr>
                        <th>วันที่ทำการจอง:</th>
                        <td>{{ date('d-m-Y', strtotime($latestReservation->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>ประเภทการจอง</th>
                        <td>{{ $latestReservation->dashboard->shipping_type}}</td>
                    </tr>
                    <tr>
                        <th>วันที่เข้า:</th>
                        <td>{{ $latestReservation->dashboard->date_entry ? date('d-m-Y', strtotime($latestReservation->dashboard->date_entry)) : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>เวลาเข้า:</th>
                        <td>{{ $latestReservation->dashboard->time_start ? date('H:i', strtotime($latestReservation->dashboard->time_start)) : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>วันที่ออก:</th>
                        <td>{{ $latestReservation->dashboard->date_exit ? date('d-m-Y', strtotime($latestReservation->dashboard->date_exit)) : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>เวลาออก:</th>
                        <td>{{ $latestReservation->dashboard->date_exit ? date('H:i', strtotime($latestReservation->dashboard->date_exit)) : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>หมายเลขที่จอด:</th>
                        <td>{{ $latestReservation->ParkingSpot ? $latestReservation->ParkingSpot->spot_number : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>ประเภทที่จอด:</th>
                        <td>{{ $latestReservation->ParkingSpot ? $latestReservation->ParkingSpot->spot_type : 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    <tr>
                        <th>ป้ายทะเบียน:</th>
                        <td>{{ $latestReservation->license_plate }}</td>
                    </tr>
                    <tr>
                        <th>ราคา:</th>
                        <td>{{ $latestReservation->price }}</td>
                    </tr>
                </table><br>
                @if ($latestReservation->parking_status == 'cancelled')
                    <p style="color: red;">การจองนี้ถูกยกเลิกแล้ว ! ! </p>
                @else
                    <form method="POST" action="{{ route('reservations.cancel', ['id' => $latestReservation->id]) }}">
                        @csrf
                        <button type="submit" class="cancel-btn">ยกเลิกการจอง</button>
                    </form>
                @endif
            </div>
        @endif

        <div id="dailySummary" class="section">
            <h1>ประวัติการจองที่จอดรถ</h1>
            <table id="summaryTable">
                <thead>
                    <tr >
                        <th style="text-align: center">วันที่ทำการจอง</th>
                        <th style="text-align: center">ประเภทการจอง</th>
                        <th style="text-align: center">วันที่เข้า</th>
                        <th style="text-align: center">เวลาเข้า</th>
                        <th style="text-align: center">วันที่ออก</th>
                        <th style="text-align: center">เวลาออก</th>
                        <th style="text-align: center">หมายเลขที่จอด</th>
                        <th style="text-align: center">ประเภทที่จอด</th>
                        <th style="text-align: center">ป้ายทะเบียน</th>
                        <th style="text-align: center">สถานะ</th>
                        <th style="text-align: center">ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($reservation->created_at)) }}</td> <!-- ใช้ $reservation แทน $latestReservation -->
                            <td>{{ $latestReservation->dashboard->shipping_type}}</td>
                            <td>{{ $reservation->dashboard->date_entry ? date('d-m-Y', strtotime($reservation->dashboard->date_entry)) : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->dashboard->time_start ? date('H:i', strtotime($reservation->dashboard->date_entry)) : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->dashboard->date_exit ? date('d-m-Y', strtotime($reservation->dashboard->date_exit)) : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->dashboard->date_exit ? date('H:i', strtotime($reservation->dashboard->date_exit)) : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->ParkingSpot ? $reservation->ParkingSpot->spot_number : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->ParkingSpot ? $reservation->ParkingSpot->spot_type : 'ไม่มีข้อมูล' }}</td>
                            <td>{{ $reservation->license_plate }}</td>
                            <td>
                                @if ($reservation->parking_status == 'cancelled')
                                    <p style="color: red;">การจองถูกยกเลิก</p>
                                @elseif ($reservation->parking_status == 'completed')
                                    <p style="color: green;">การจองสำเร็จ</p>
                                @else
                                    <p>กำลังดำเนินการ</p>
                                @endif
                            </td>
                            <td>{{ number_format($reservation->price, 2) }} ฿</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


{{-- @extends('layouts.sidebar')

@section('title', 'ประวัติการจองที่จอดรถ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('user-reservation.css') }}">
@endpush

@section('content')
    <div class="container">
        <!-- แสดงการจองล่าสุด -->
        @if ($latestReservation)
            <div class="latest-reservation">
                <h2>การจองล่าสุด</h2>
                <table>
                    <tr>
                        <th>ประเภทการจอง:</th>
                        <td>{{ $latestReservation->parking_type }}</td>
                    </tr>
                    <tr>
                        <th>วันที่จอง:</th>
                        <td>{{ $latestReservation->booking_date }}</td>
                    </tr>
                    <tr>
                        <th>เวลาเข้า:</th>
                        <td>{{ $latestReservation->start_time }}</td>
                    </tr>
                    <tr>
                        <th>เวลาออก:</th>
                        <td>{{ $latestReservation->end_time }}</td>
                    </tr>
                    <tr>
                        <th>หมายเลขที่จอง:</th>
                        <td>{{ $latestReservation->reservation_number }}</td>
                    </tr>
                    <tr>
                        <th>ประเภทที่จอด:</th>
                        <td>{{ $latestReservation->dashboard->vehicle_type }}</td>
                    </tr>
                    <tr>
                        <th>ป้ายทะเบียน:</th>
                        <td>{{ $latestReservation->license_plate }}</td>
                    </tr>
                    <tr>
                        <th>สถานะ:</th>
                        <td>{{ $latestReservation->parking_status }}</td>
                    </tr>
                    <tr>
                        <th>ราคา:</th>
                        <td>{{ $latestReservation->price }}</td>
                    </tr>
                </table>
            </div>
        @endif

        <div id="dailySummary" class="section">
            <h1>ประวัติการจองที่จอดรถ</h1>
            <table id="summaryTable">
                <thead>
                    <tr>
                        <th>วันที่จอง</th>
                        <th>เวลาเข้า</th>
                        <th>เวลาออก</th>
                        <th>หมายเลขที่จอด</th>
                        <th>ประเภทที่จอด</th>
                        <th>ป้ายทะเบียน</th>
                        <th>สถานะ</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->booking_date }}</td>
                            <td>{{ $reservation->start_time }}</td>
                            <td>{{ $reservation->end_time }}</td>
                            <td>{{ $reservation->reservation_number }}</td>
                            <td>{{ $reservation->dashboard->vehicle_type }}</td>
                            <td>{{ $reservation->license_plate }}</td>
                            <td>{{ $reservation->parking_status }}</td>
                            <td>{{ $reservation->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection --}}
