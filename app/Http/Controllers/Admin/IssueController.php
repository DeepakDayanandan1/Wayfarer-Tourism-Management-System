<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::with('user')->orderBy('id', 'desc')->paginate(15);
        return view('admin.issues.index', compact('issues'));
    }

    public function show($id)
    {
        $issue = Issue::with('user')->findOrFail($id);
        return view('admin.issues.show', compact('issue'));
    }

    public function updateRemark(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);

        $request->validate([
            'remark' => 'required|string|max:2000',
        ]);

        $issue->update([
            'AdminRemark' => $request->remark,
            'AdminremarkDate' => now(),
        ]);

        return redirect()->route('admin.issues.index')->with('success', 'Remark added and ticket #' . $id . ' updated.');
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('admin.issues.index')->with('success', 'Support ticket #' . $id . ' deleted successfully.');
    }
}

