<?php

namespace App\Http\Controllers;

use App\DataTables\ActivityLogsDataTable;
use App\Models\Report;
use App\DataTables\ReportsDataTable;
use App\Models\ReportTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function masterDashboard(ReportsDataTable $dataTable)
    {
        $activeUser = Auth::guard('web')->user();
        $page = 'dashboard';
        return $dataTable->render('admin.admin_dashboard', compact('activeUser', 'page'));
    }
    public function openReport(Request $request)
    {
        $id = $request->report_id;
        $report = Report::find($id);
        $activeUser = Auth::guard('web')->user();
        $mediaItems = $report->getMedia("*");
        return view("admin.report_detail", compact("report", 'activeUser', 'mediaItems'));
    }
    public function processReport(Request $request)
    {
        $report = Report::find($request->id);
        $activeUser = Auth::guard('web')->user();
        $status = '';
        // tipe proses
        if ($request->verifikasi) {
            $status = 'Proses Administratif';
            $report->update(['category_id' => $request->kategori, 'status' => $status]);
        } elseif ($request->update) {
            $status = $request->status;
            $report->update(['status' => $status]);
        } else {
            $status = 'Laporan Ditolak';
            $report->update(['status' => $status]);
        }
        // report track
        $report->tracks()->create([
            'user_id' => $activeUser->id,
            'report_id' => $report->id,
            'status' => $status,
            'note' => $request->note,
        ]);
        activity()
            ->useLog('Proses Laporan')
            ->causedBy($activeUser)
            ->performedOn($report)
            ->event($status)
            ->withProperties(['agent' => [
                'ip' => request()->ip(),
                "device" => request()->userAgent()
            ]])
            ->log('Status diubah menjadi ' . $status);
        return back();
    }
    function masterActivity(ActivityLogsDataTable $dataTable)
    {
        $activeUser = Auth::guard('web')->user();
        $page = 'activity';
        return $dataTable->render('admin.admin_activity_tracker', compact('activeUser', 'page'));
    }

    public function masterReport(Request $request)
    {
        $id = $request->id;
        $report = Report::find($id);
        $activeUser = Auth::guard('web')->user();
        $page = 'report';
        $mediaItems = $report->getMedia("*");
        return view("admin.admin_report", compact('report', 'activeUser', 'page', 'mediaItems'));
    }
}
