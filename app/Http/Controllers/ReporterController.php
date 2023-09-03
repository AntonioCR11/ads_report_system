<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function reportForm()
    {
        return view('reporter.report_form');
    }
    public function submitReport(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'identity_type' => 'required',
            'identity_number' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'title' => 'required',
            'description' => 'required',
            // 'foto' => ['required', new ImageCount(count(($request->file("foto") != null) ? $request->file("foto") : []))]
        ]);
        $reporter = Reporter::where('email', $request->email)->first();
        if (!$reporter) {
            $reporter = Reporter::create($request->all());
        }

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
}
