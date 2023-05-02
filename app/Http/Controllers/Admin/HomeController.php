<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventHistory;
use App\Models\Events;
use App\Models\History;
use App\Models\HistorySend;
use App\Models\Setting;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $_data = [];

    public function index(Request $request){
        $search = $request->search;

        $list = History::selectRaw("COUNT(id) as sumID, SUM(amount) as amount, SUM(amount_paid) as amount_paid, id_momo");
        if($search){
            $list->where("id_momo", $search);
        }
        $list = $list->groupBy("id_momo")->orderBy(DB::raw("SUM(amount)"), "DESC")->paginate(10);
        $formatStartDate = "Y-m-d 00:00:00";
        $formatEndDate = "Y-m-d 23:59:59";

        $startDate = now()->format($formatStartDate);
        $endDate = now()->format($formatEndDate);

        $startLastDate = now()->subDays()->format($formatStartDate);
        $endLastDate = now()->subDays()->format($formatEndDate);

        $startWeek = now()->startOfWeek()->format($formatStartDate);
        $endWeek = now()->endOfWeek()->format($formatEndDate);

        $startMonth = now()->startOfMonth()->format($formatStartDate);
        $endMonth = now()->endOfMonth()->format($formatEndDate);

        $todayAmountFail = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereNotIn("status", [4,5])
            ->whereBetween("created_at", [$startDate, $endDate])->first();
        $today = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereBetween("created_at", [$startDate, $endDate])->first();
        $revenueToday = HistorySend::selectRaw("sum(amount) as amount")
            ->whereNotNull("trans_id")
            ->whereBetween("created_at", [$startDate, $endDate])->first();

        $lastDayAmountFail = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereNotIn("status", [4,5])
            ->whereBetween("created_at", [$startLastDate, $endLastDate])->first();
        $lastDay = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereBetween("created_at", [$startLastDate, $endLastDate])->first();
        $revenueLastDay = HistorySend::selectRaw("sum(amount) as amount")
            ->whereNotNull("trans_id")
            ->whereBetween("created_at", [$startLastDate, $endLastDate])->first();

        $currentWeekAmountFail = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereNotIn("status", [4,5])
            ->whereBetween("created_at", [$startWeek, $endWeek])->first();
        $currentWeek = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereBetween("created_at", [$startWeek, $endWeek])->first();
//        $revenueCurrentWeek = HistorySend::selectRaw("sum(amount) as amount")
//            ->whereNotNull("trans_id")
//            ->whereBetween("created_at", [$startWeek, $endWeek])->first();

        $currentMonthAmountFail = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereNotIn("status", [4,5])
            ->whereBetween("created_at", [$startMonth, $endMonth])->first();
        $currentMonth = History::selectRaw("sum(amount) as amount, SUM(amount_paid) as amount_paid")
            ->whereBetween("created_at", [$startMonth, $endMonth])->first();
        $revenueCurrentMonth = HistorySend::selectRaw("sum(amount) as amount")
            ->whereNotNull("trans_id")
            ->whereBetween("created_at", [$startMonth, $endMonth])->first();

        $eventCurrentDay = EventHistory::selectRaw("sum(reward) as total")->whereBetween("created_at", [$startDate, $endDate])->first();
        $eventLastDay = EventHistory::selectRaw("sum(reward) as total")->whereBetween("created_at", [$startLastDate, $endLastDate])->first();
        $eventCurrentMonth = EventHistory::selectRaw("sum(reward) as total")->whereBetween("created_at", [$startMonth, $endMonth])->first();
        $this->_data["startDate"] = $startDate;
        $this->_data["endDate"] = $endDate;
        $this->_data["startLastDate"] = $startLastDate;
        $this->_data["endLastDate"] = $endLastDate;
        $this->_data["startWeek"] = $startWeek;
        $this->_data["endWeek"] = $endWeek;
        $this->_data["startMonth"] = $startMonth;
        $this->_data["endMonth"] = $endMonth;

        $this->_data["todayAmountFail"] = $todayAmountFail;
        $this->_data["today"] = $today;
        $this->_data["revenueToday"] = $revenueToday;
        $this->_data["eventCurrentDay"] = $eventCurrentDay->total ?? 0;


        $this->_data["lastDayAmountFail"] = $lastDayAmountFail;
        $this->_data["lastDay"] = $lastDay;
        $this->_data["revenueLastDay"] = $revenueLastDay;
        $this->_data["eventLastDay"] = $eventLastDay->total ?? 0;

        $this->_data["currentWeekAmountFail"] = $currentWeekAmountFail;
        $this->_data["currentWeek"] = $currentWeek;

        $this->_data["currentMonthAmountFail"] = $currentMonthAmountFail;
        $this->_data["currentMonth"] = $currentMonth;
        $this->_data["revenueCurrentMonth"] = $revenueCurrentMonth;
        $this->_data["eventCurrentMonth"] = $eventCurrentMonth->total ?? 0;

        $this->_data["list"] = $list;
        $this->_data["search"] = $search;
        $this->_data["titlePage"] = "THỐNG KÊ";

        return view('admin.dashboard', $this->_data);
    }

    public function setting(){
        $this->_data['item'] = Setting::first();
        $this->_data["titlePage"] = "Cài Đặt Website";
        return view('admin.setting', $this->_data);
    }

    public function support(){
        $this->_data["titlePage"] = "Link Hỗ trợ";
        $this->_data['list'] = Support::orderBy('created_at', 'DESC')->get();
        return view('admin.support', $this->_data);
    }

    public function eventDay(){
        $this->_data["titlePage"] = "Cài Đặt";
        $this->_data["list"] = Events::where('type', 'day')->get();
        return view('admin.eventDay', $this->_data);
    }

    public function eventDayHistory(Request $request){
        $limit = 50;
        $this->_data["titlePage"] = "Lịch Sử Trả Thưởng";
        $this->_data["list"] = EventHistory::orderBy("created_at", "DESC")->paginate($limit);
        $this->_data['total'] = $this->_data['list']->total();
        $this->_data['limit'] = $limit;
        return view('admin.events.history', $this->_data);
    }

    public function historyDate(Request $request){
        $limit = 30;
        $currentDate = now()->format("Y-m-d");
        $search = $request->search;
        $search2 = $request->search2;
        $refund = 0;

        $list = History::selectRaw("COUNT(id) as sumID, SUM(amount) as amount, SUM(amount_paid) as amount_paid, id_momo");
        $list2 = History::selectRaw("COUNT(id) as sumID, SUM(amount) as amount, SUM(amount_paid) as amount_paid, id_momo");
        $setting = Setting::first();
        if($setting){
            $refund = $setting->refund;
        }
        if($search){
            $list->where("id_momo", $search);
        }
        if($search2){
            $list2->where("id_momo", $search2);
        }
        $list = $list->groupBy("id_momo")
            ->orderBy(DB::raw("SUM(amount)"), "DESC")
            ->whereDate("created_at", $currentDate)
            ->paginate($limit);
        $list2 = $list2->groupBy("id_momo")
            ->orderBy(DB::raw("SUM(amount)"), "DESC")
            ->whereIn("status",[3,4,6])
            ->whereDate("created_at", $currentDate)
            ->paginate($limit);
        $this->_data['list'] = $list;
        $this->_data['list2'] = $list2;
        $this->_data['refund'] = $refund;
        $this->_data['total'] = $this->_data['list']->total();
        $this->_data['limit'] = $limit;
        $this->_data['search'] = $search;
        $this->_data["titlePage"] = "Thống Kê Ngày";
        return view('admin.historyDate', $this->_data);
    }

}
