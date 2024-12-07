<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    // Show the Budget Table
    public function index()
    {
        $budgets = Budget::where('user_id', auth()->id())->get();
        return view('budget.index', compact('budgets'));
    }

    // Show the Add Budget Form
    public function create()
    {
        return view('budget.create');
    }

    // Handle Budget Form Submission
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'month_year' => 'required|date_format:Y-m', // Ensures it's in YYYY-MM format
            'category' => 'required|string|max:255',
            'budget_amount' => 'required|numeric',
        ]);
    
        // Append '-01' to create a valid date
        $formattedMonthYear = $request->month_year . '-01';
    
        // Save the budget
        Budget::create([
            'user_id' => auth()->id(),
            'month_year' => $formattedMonthYear,
            'category' => $request->category,
            'budget_amount' => $request->budget_amount,
            'remaining_amount' => $request->budget_amount,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('budgets.index')->with('success', 'Budget added successfully!');
    }
    public function destroy($id)
    {
        // Ensure the budget belongs to the authenticated user
        $budget = Budget::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the budget
        $budget->delete();

        // Redirect with a success message
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully!');
    }
    public function spend()
    {
        // Get unique budget categories from the budgets table
        $categories = Budget::where('user_id', auth()->id())
                            ->pluck('category')
                            ->unique()
                            ->toArray();

        // Pass categories to the view
        return view('budget.spend', compact('categories'));
    }
    public function storeSpend(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the budget record by category and user
        $budget = Budget::where('user_id', auth()->id())
                        ->where('category', $request->category)
                        ->first();

        if (!$budget) {
            return redirect()->route('budgets.spend')->withErrors('Selected category does not exist.');
        }

        // Subtract the amount spent from the remaining amount
        $budget->remaining_amount -= $request->amount;

        // Save the updated budget
        $budget->save();

        // Check for overspending
        if ($budget->remaining_amount < 0) {
            $overspent = abs($budget->remaining_amount);
            return redirect()->route('budgets.index')->with('success', "Expense recorded! You have overspent by $${overspent} in the '{$budget->category}' category.");
        }

        return redirect()->route('budgets.index')->with('success', 'Expense recorded successfully!');
    }

}
