<?php

namespace App\Http\Controllers;

use App\DataTables\ReportsDataTable;
use App\DataTables\Scopes\ActiveUser;
use App\Models\Report;
use App\Models\Reporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReporterController extends Controller
{
    public function reportDashboard(ReportsDataTable $dataTable)
    {
        $activeUser = Reporter::find(Session::get('reporter_id'));
        $page = 'dashboard';
        return $dataTable->addScope(new ActiveUser())->render('reporter.reporter_dashboard', compact('activeUser', 'page'));
    }
    public function reportForm()
    {
        $activeUser = Reporter::find(Session::get('reporter_id'));
        $page = 'report';
        return view('reporter.report_form', compact('activeUser', 'page'));
    }
    public function submitReport(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $reporter = Reporter::find(Session::get('reporter_id'));

        $dateNow = date('Ymd');
        $reports = Report::where(
            function ($q) use ($dateNow) {
                $q
                    ->where('ticket_id', 'like', "%$dateNow%");
            }
        )->get();
        $ticket_id = $dateNow . (intval(count($reports)) + 1);
        $report = Report::create([
            'reporter_id' => $reporter->id,
            'category_id' => null,
            'ticket_id' => $ticket_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending'
        ]);

        if ($request->hasFile('foto')) {
            for ($i = 0; $i < count($request->file('foto')); $i++) {
                $media = $request->file('foto')[$i];
                $report->addMedia($media)->toMediaCollection();
            }
        }
        // else {
        //     $report->addMedia(public_path('storage/images/blank_img.png'))
        //         ->toMediaCollection();
        // }
        return back()->with('successMessage', 'Laporan berhasil disubmit!');
    }
    public function masterReport(Request $request)
    {
        $id = $request->id;
        $report = Report::find($id);
        $activeUser = Reporter::find(Session::get('reporter_id'));
        $page = 'report';
        $mediaItems = $report->getMedia("*");
        return view("reporter.report_detail", compact('report', 'activeUser', 'page', 'mediaItems'));
    }
}
