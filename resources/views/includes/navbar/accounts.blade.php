<!-- Customers -->
<li>
    <a href="javascript: void(0);"> <i class="fas fa-user-circle"></i><span>Customer</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.customer.create')}}" class="parent-a"><i class="fas fa-user-plus"></i><span>Add Customer</span></a></li>
        <li><a href="{{route('dashboard.accounts.customer.index')}}" class="parent-a"><i class="fas fa-user-friends"></i><span>Customer List</span></a></li>
        <li><a href="{{route('customer.credit')}}" class="parent-a"><i class="fas fa-credit-card"></i><span>Credit Customer</span></a></li>
        <li><a href="{{route('paid.customer')}}" class="parent-a"><i class="fas fa-handshake"></i><span>Paid Customer</span></a></li>
        <li><a href="{{route('customer.ledger')}}" class="parent-a"><i class="fas fa-book"></i><span>Customer Ledger</span></a></li>
        <li><a href="{{route('customer.advance')}}" class="parent-a"><i class="fas fa-forward"></i><span>Customer Advance</span></a></li>
    </ul>
</li>
<!-- Suppliers -->
<li>
    <a href="javascript: void(0);"> <i class="fa fa-user-secret"></i><span>Supplier</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.supplier.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Add Supplier</span></a></li>
        <li><a href="{{route('dashboard.accounts.supplier.index')}}" class="parent-a"><i class="fas fa-list-ul"></i><span>Supplier List</span></a></li>
        <li><a href="{{route('supplier.ledger')}}" class="parent-a"><i class="fas fa-book"></i><span>Supplier Ledger</span></a></li>
        <li><a href="{{route('supplier.advance')}}" class="parent-a"><i class="fas fa-forward"></i><span>Supplier Advance</span></a></li>
    </ul>
</li>
<!-- Purchase -->
<li>
    <a href="javascript: void(0);"><i class="far fa-money-bill-alt"></i><span>Purchase</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.purchase.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Add Purchase</span></a></li>
        <li><a href="{{route('dashboard.accounts.purchase.index')}}" class="parent-a"><i class="fas fa-edit"></i><span>Manage Purchase</span></a></li>
    </ul>
</li>
<!-- Sale -->
<li>
    <a href="javascript: void(0);"> <i class="fas fa-chart-line"></i><span>Sale</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.sale.create')}}" class="parent-a"><i class="fas fa-plus-circle"></i><span>Add New Sale</span></a></li>
        <li><a href="{{route('dashboard.accounts.sale.index')}}" class="parent-a"><i class="fas fa-edit"></i><span>Manage Sales</span></a></li>
        {{--                    <li><a href="{{route('gui.pos')}}" class="parent-a"><i class="fas fa-edit"></i><span>POS Sale</span></a></li>--}}
    </ul>
</li>
<!-- Petty Cash -->
<li>
    <a href="javascript: void(0);"> <i class="fas fa-shopping-basket"></i><span>PettyCash</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('pettycash.ledger')}}" class="parent-a" ><i class="fas fa-book"></i><span>PettyCash Ledger</span></a></li>

    </ul>
</li>
<!-- Income -->
<li>
    <a href="javascript: void(0);"><i class="fas fa-wallet"></i>Income<span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.incomehead.create')}}" class="child-a" ><i class="fas fa-plus-circle"></i><span>Create Income Head</span></a>
        </li>
        <li><a href="{{route('dashboard.accounts.incomehead.index')}}" class="child-a" ><i class="fas fa-edit"></i><span>Manage Income Head</span></a>
        </li>
        <li><a href="{{route('dashboard.accounts.income.create')}}" class="child-a" ><i class="fas fa-plus-circle"></i><span>Create Income</span></a></li>
        <li><a href="{{route('dashboard.accounts.income.index')}}" class="child-a" ><i class="fas fa-edit"></i><span>Manage Income</span></a></li>
        <li><a href="{{route('income.statement')}}" class="child-a" ><i class="fas fa-book"></i><span>Income Statement</span></a></li>
    </ul>
</li>
<!-- Expense -->
<li>
    <a href="javascript: void(0);"><i class="fas fa-coins"></i><span>Expense</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('dashboard.accounts.expensehead.create')}}" class="child-a">Create Expense Head</a>
        </li>
        <li><a href="{{route('dashboard.accounts.expensehead.index')}}" class="child-a">Manage Expense Head</a>
        </li>
        <li><a href="{{route('dashboard.accounts.expense.create')}}" class="child-a">Create Expense</a></li>
        <li><a href="{{route('dashboard.accounts.expense.index')}}" class="child-a">Manage Expense</a></li>
        <li><a href="{{route('expense.statement')}}" class="child-a">Expense Statement</a></li>

    </ul>
</li>
<!-- Quick Accounts -->
<li>
    <a href="javascript: void(0);"><i class="far fa-money-bill-alt"></i><span>Quick Accounts</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('charts.account')}}" class="parent-a">Charts of Account</a></li>
        <li><a href="{{route('supplier.payment')}}" class="parent-a" >Supplier Payment</a></li>
        {{--<li><a href="{{route('customer.receive')}}" class="parent-a" >Customer Receive</a></li>--}}
        <li><a href="{{route('dashboard.accounts.journal.voucher.create')}}" class="parent-a" >Journal Voucher</a></li>
    </ul>
</li>
<!-- Quick Reports -->
<li>
    <a href="javascript: void(0);"> <i class="fas fa-book-open"></i><span> Quick Reports</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('today.report')}}" class="parent-a" >Today's Report</a></li>
        {{--<li><a href="{{route('sales.report')}}" class="parent-a" >Sales Report</a></li>--}}
        <li><a href="{{route('due.report')}}" class="parent-a" >Due Report</a></li>
        <li><a href="{{route('cash.book')}}" class="child-a" >Cash Book</a></li>
        <li><a href="{{route('purchase.report')}}" class="parent-a" >Purchase Report</a></li>
        <li><a href="{{route('balance.sheet')}}" class="child-a" >Balance Sheet</a></li>
    </ul>
</li>
<!-- Accounts -->
<li>
    <a href="javascript: void(0);"><i class="far fa-money-bill-alt"></i><span>Accounts</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li><a href="{{route('opening.balance')}}" class="parent-a">Opening Balance</a></li>
        <li><a href="{{route('cash.adjustment')}}" class="parent-a">Cash Adjustment</a></li>
        <li><a href="{{route('dashboard.accounts.debit.voucher.create')}}" class="parent-a">Debit Voucher</a></li>
        <li><a href="{{route('dashboard.accounts.credit.voucher.create')}}" class="parent-a">Credit Voucher</a></li>
        <li><a href="{{route('dashboard.accounts.contra.voucher.create')}}" class="parent-a">Contra Voucher</a></li>
        <li><a href="{{route('dashboard.accounts.voucher.approval.index')}}" class="parent-a">Voucher Approval</a></li>

        <li>
            <a href="javascript: void(0);" class="parent-a">Office Loan<span class="menu-arrow left-has-menu"><i
                        class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="{{route('dashboard.accounts.person.create')}}">Add Person</a></li>
                <li><a href="{{route('dashboard.accounts.person.index')}}">Manage Person</a></li>
                <li><a href="{{route('add.loan')}}">Add Loan</a></li>
                <li><a href="{{route('add.payement')}}">Add Payment</a></li>

            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="parent-a">Personal Loan<span class="menu-arrow left-has-menu"><i
                        class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="{{route('dashboard.accounts.person_1.create')}}" class="child-a">Add Person</a></li>
                <li><a href="{{route('dashboard.accounts.person_1.index')}}" class="child-a">Manage Person</a></li>
                <li><a href="{{route('add.loan_1')}}" class="child-a">Add Loan</a></li>
                <li><a href="{{route('add.payement_1')}}" class="child-a">Add Payment</a></li>

            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="parent-a"> <i class="fas fa-book-open"></i> Report <span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="{{route('inventory.ledger')}}" class="child-a">Inventory Ledger </a></li>
                <li><a href="{{route('bank.book')}}" class="child-a">Bank Book</a></li>
                <li><a href="{{route('general.ledger')}}" class="child-a">General Ledger</a></li>
                <li><a href="{{route('general.head')}}" class="child-a">General Head</a></li>
                <li><a href="{{route('trail.balance')}}" class="child-a">Trail Balance</a></li>
                <li><a href="{{route('profit.loss')}}" class="child-a">Profit Loss</a></li>
                <li><a href="{{route('cash.flow')}}" class="child-a">Cash Flow</a></li>
                <li><a href="{{route('coa.print')}}" class="child-a">Coa Print</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="parent-a" > <i class="far fa-money-bill-alt"></i>Tax<span
                    class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li><a href="{{route('dashboard.accounts.tax.create')}}" class="child-a" ><i class="fas fa-plus-circle"></i><span>Add Tax</span></a></li>
                <li><a href="{{route('dashboard.accounts.tax.index')}}" class="child-a" ><i class="fas fa-plus-circle"></i><span>Manage Tax</span></a></li>
            </ul>
        </li>
    </ul>
</li>
<!-- Reports -->
<li>
    <a href="javascript: void(0);"> <i class="fas fa-book-open"></i><span>  Reports</span><span
            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
    <ul class="nav-second-level" aria-expanded="false">
        <li>
            <a href="{{route('booking.advance.payment.report')}}" class="parent-a">Advance Payments Report</a>
        </li>
        <li><a href="{{route('dashboard.accounts.closing.report.index')}}" class="parent-a">Closing</a></li>
        <li><a href="{{route('closing.report')}}" class="parent-a">Closing Report</a></li>
        <li><a href="{{route('today.customer.receipt')}}" class="parent-a">Today's Customer Receipts</a></li>
        <li><a href="{{route('user_wise.sales_report')}}" class="parent-a">User wise Sales Report</a></li>
        <li><a href="{{route('shipping.cost_report')}}" class="parent-a">Shipping Cost Report</a></li>
        <li><a href="{{route('purchase_report.category_wise')}}" class="parent-a">Purchase Report (Category wise)</a></li>
        <li><a href="{{route('product.wise')}}" class="parent-a">Sales Report (Product Wise)</a></li>
        <li><a href="{{route('sales_report.category_wise')}}" class="parent-a">Sales Report (Category Wise)</a></li>
        <li><a href="{{route('sales.return')}}" class="parent-a">Sales Return</a></li>
        <li><a href="{{route('supplier.return')}}" class="parent-a">Supplier Return</a></li>
        <li><a href="{{route('tax.report')}}" class="parent-a">Tax Report</a></li>
        <li><a href="{{route('profit_report.sales_wise')}}" class="parent-a">Profit Report (Sales Wise)</a></li>

    </ul>
</li>
