# i-ALQORI - Page Contents Guide

## System Overview

i-ALQORI is a tuition/class management system for Quran learning centers with role-based access:
- **Admin (Role 1):** Full access to all pages
- **Teacher (Role 2):** Access to teacher-specific pages
- **Client/Registrar (Role 4):** Access to client-specific pages

---

## ADMIN / SUPERUSER PAGES

### 1. Dashboard (`/admin`)

**Widgets:**
| Widget | Content |
|--------|---------|
| Total Fee December 2025 | Sum of all fees for December 2025 |
| Total Allowance December 2025 | Sum of all teacher allowances |
| Overdue Balance December 2025 | Total unpaid fees |
| ChartSale | Sales/earnings chart visualization |
| OverduePayment | List of overdue payments |

---

### 2. UserResource (`/admin/users`)

**Manage System Users**

| Field | Label | Type | Description |
|-------|-------|------|-------------|
| name | Nama | TextInput | User full name |
| code | Kod Ahli | TextInput | Member/code identifier |
| phone | No.Tel | TextInput | Phone number |
| email | ID Log Masuk | TextInput | Login ID (email) |
| password | Kata Laluan Baru | Password | Login password |
| roles | Role | Select (multiple) | Assign Spatie roles |

**Table Columns:**
- ID, Name, Phone, Code, Role, Email, Created Date, Deleted Date

**Actions:** Edit, Impersonate (login as user)

**Bulk Actions:** Export to Excel, Delete, Assign Role, Append Text to Email

---

### 3. AssignClassTeacher (`/admin/assign-class-teachers`)

**Assign Teachers to Client Classes**

| Field | Label | Type | Description |
|-------|-------|------|-------------|
| teacher_id | Guru | Select | Users with Role 2 (Teachers) |
| registrar_id | Klien | Select | Users with Role 4 (Clients) |
| assign_class_code | Kod Kelas | TextInput | Unique class code |
| class_name_id | Nama Kelas | Multiple Select | Class names (many-to-many) |
| class_package_id | Pakej Kelas | Select | Class package |

**Table Display:**
- ID, Teacher Name, Client Name, Class Code, Classes (badge style)

**Relationships:**
- Belongs to User (teacher)
- Belongs to User (registrar/client)
- Belongs to Many ClassName
- Belongs to Many ClassPackage

---

### 4. ClassName (`/admin/class-names`)

**Define Class Types**

| Field | Label | Type |
|-------|-------|------|
| name | Nama | TextInput |
| feeperhour | Yuran Per Jam | Money (MYR) |
| allowanceperhour | Elaun Per Jam | Money (MYR) |

**Table Columns:** ID, Name, Fee Per Hour, Allowance Per Hour, Created/Updated/Deleted Dates

---

### 5. ClassPackage (`/admin/class-packages`)

**Class Package Definitions**

| Field | Label | Type |
|-------|-------|------|
| name | Nama | TextInput |
| total_hour | Jumlah Jam | TextInput |

**Table Columns:** ID, Name, Total Hours

---

### 6. FeeRate (`/admin/fee-rates`) - Hidden Page

**Fee Rate Rules by Hours**

| Field | Label | Type |
|-------|-------|------|
| class_names_id | Nama Kelas | Select |
| total_hours_min | Minima Jam | Numeric |
| total_hours_max | Maksima Jam | Numeric |
| feeperhour | Yuran Per Jam | Currency (RM) |

**Table Columns:** ID, Class Name, Min Hours, Max Hours, Fee Per Hour

**Relationship:** Belongs to ClassName

---

### 7. ReportClass (`/admin/report-classes`)

**Monthly Class Reports**

| Field | Label | Type | Description |
|-------|-------|------|-------------|
| registrar_id | Klien | Select | Client selection |
| class_names_id | Nama Kelas | Select | Primary class |
| date | Tarikh Kelas | Repeater (DatePicker) | Multiple class dates |
| total_hour | Jumlah Jam Kelas Sebulan | Select | Hours (0-22) |
| class_names_id_2 | Nama Kelas Kedua | Select | Secondary class (combo) |
| date_2 | Tarikh Kelas Kedua | Repeater (DatePicker) | Secondary class dates |
| total_hour_2 | Jumlah Jam Kelas Kedua Sebulan | Select | Secondary hours |
| allowance | Elaun | Hidden | Default 10 |
| fee_student | Yuran | Hidden | Default 10 |
| month | Month | Hidden | Report month |
| status | Status | Select | Payment status |
| note | Nota | Textarea | Additional notes |
| receipt | Resit | File upload | Payment receipt |

**Table Columns:**
- ID, Teacher Name, Client Name, Client Code, Month, Allowance (MYR), Fee (MYR), Date 1, Date 2

**Groupings:** Created By Name, Registrar Name, Month

**Filters:** Deleted (ternary), Month (dropdown 2022-2025)

**Relationships:**
- Belongs to ClassName (class_name)
- Belongs to ClassName (class_name_2 - second class)
- Belongs to User (registrar)
- Belongs to User (created_by)

---

## TEACHER PAGES (Role 2)

### 8. Kelas (`/teacher/your-class`)

**Livewire Component:** `ListYourClass`

**Purpose:** View classes assigned to the logged-in teacher

**Query:** `AssignClassTeacher::where('teacher_id', Auth::id())`

**Table Columns:**
| Column | Content |
|--------|---------|
| ID | Record ID |
| Teacher Name | Logged-in teacher |
| Client Name | Client/student name |
| Client Code | Client code |
| Classes | Class names (badge style) |

**Bulk Actions:** Export to Excel, Delete

**Access Permission:** `view_your_class`

---

### 9. Yuran Pelajar (`/teacher/fee-student`)

**Livewire Component:** `ListFee`

**Purpose:** View and manage student fees teacher for the

**Table Columns:**
| Column | Content |
|--------|---------|
| ID | Record ID |
| Teacher Name | Teacher |
| Client Name | Client/parent |
| Client Code | Client code |
| Phone | Phone number |
| Month | Report month |
| Fee (MYR) | Fee amount |
| Note | Notes |
| Status | Payment status badge |
| Resit | Receipt image |

**Payment Status Values:**
| Status | Label | Color | Description |
|--------|-------|-------|-------------|
| 0 | Belum Bayar | danger | Not paid |
| 1 | Dah Bayar | success | Paid |
| 2 | Dalam Proses Transaksi | primary | In transaction |
| 3 | Gagal Bayar | info | Payment failed |
| 4 | Dalam Proses | gray | Processing |
| 5 | Yuran Terlebih | warning | Overpaid |

**Actions:**
- PDF Invoice - Generate PDF invoice
- Bayar - Link to ToyyibPay payment gateway
- Sunting - Edit status/note

**Bulk Actions:** Export to Excel, Delete

**Filters:** Status, Month

**Access Permission:** `view_any_fee::student`

---

### 10. Elaun Guru (`/teacher/allowance`)

**Livewire Components:** `ReportDateStats` + `ListAllowance`

**Purpose:** View teacher allowance records

**Stats Widget:**
| Stat | Description |
|------|-------------|
| Early Allowance | Before 1/1/26 |
| Late Allowance | On/after 1/1/26 |
| Unpaid Allowance | Pending payments |

**Table Columns:**
| Column | Content |
|--------|---------|
| Teacher ID | Teacher ID |
| Teacher Name | Teacher name |
| Submitted Date | Report submission date |
| Month | Report month |
| Allowance (MYR) | Allowance amount with sum |
| Status | Payment status badge |

**Allowance Status Values:**
| Status | Label | Color |
|--------|-------|-------|
| dah_bayar | Dah Bayar | success (green) |
| belum_bayar | Belum Bayar | danger (red) |
| NULL | Tiada Data | gray |

**Bulk Actions:** Export to Excel, Delete, Edit (admin only)

**Filters:** Allowance Status, Month

**Access Permission:** `view_any_allowance::report`

---

### 11. Info (`/teacher/info`)

**Livewire Component:** `Memo`

**Purpose:** System announcements/notifications

**Display:**
- Badge indicator showing unread count (warning color)
- List of memos/announcements

**Access Permission:** `view_any_memo`

---

## CLIENT PAGES (Role 4)

### 12. Klien Saya (`/client/my-clients`)

**Livewire Component:** `ListMyClients`

**Purpose:** View assigned teachers

**Table Columns:**
| Column | Content |
|--------|---------|
| Teacher Name | Assigned teacher |
| Client Name | Current client |

**Access Permission:** `view_any_my_clients`

---

### 13. Guru Kelas (`/client/client-class`)

**Livewire Component:** `ListClientClass`

**Purpose:** View classes for current client

**Query:** `AssignClassTeacher::where('registrar_id', Auth::id())`

**Table Columns:**
| Column | Content |
|--------|---------|
| ID | Record ID |
| Client Name | Current client |
| Client Code | Client code |
| Teacher Name | Assigned teacher |
| Classes | Class names (badge style) |

**Bulk Actions:** Export to Excel

**Access Permission:** `view_teacher_class`

---

### 14. Yuran Bulanan (`/client/monthly-fee`)

**Livewire Components:** `ListMonthlyFee` + `Alert`

**Purpose:** View monthly fees for current client

**Query:** `ReportClass::where('registrar_id', auth()->id())`

**Table Columns:**
| Column | Content |
|--------|---------|
| ID | Record ID |
| Teacher Name | Teacher |
| Client Name | Client |
| Client Code | Client code |
| Phone | Phone number |
| Month | Report month |
| Fee (MYR) | Fee amount |
| Note | Notes |
| Status | Payment status badge |
| Resit | Receipt image |

**Actions:**
- Bayar - Link to ToyyibPay payment
- PDF Invoice - Generate PDF invoice

**Filters:** Status, Month

**Access Permission:** `view_monthly_fee`

---

### 15. Rekod Transaksi (`/client/transaction`)

**Livewire Component:** `ListTransaction`

**Purpose:** View transaction records for current client

**Query:** `ReportClass::where('registrar_id', auth()->id())`

**Table Columns:**
| Column | Content |
|--------|---------|
| ID | Record ID |
| Teacher Name | Teacher |
| Client Name | Client |
| Client Code | Client code |
| Phone | Phone |
| Month | Month |
| Fee (MYR) | Fee amount |
| Note | Notes |
| Status | Select (disabled) |
| Resit | Receipt image |

**Actions:**
- Bayar - Payment link
- PDF Resit - Generate receipt PDF

**Filters:** Status, Month

**Access Permission:** `view_any_transaction`

---

## ADMIN-ONLY / MANAGEMENT PAGES

### 16. Yuran Tertunggak (`/admin/overdue-pay-list`)

**Livewire Component:** `OverduePayList`

**Purpose:** View overdue payment summary grouped by client

**Table Columns:**
| Column | Content |
|--------|---------|
| Registrar ID | Client ID |
| Registrar Name | Client name |
| Registrar Code | Client code |
| Status Count | Count of status != 0 (unpaid) |

**Access Permission:** `view_any_overdue::fee`

---

### 17. Tambah Kelas (`/admin/add-class`)

**Page:** `AddClass`

**Purpose:** Add new class assignments

**Access Permission:** `view_any_add_class`

---

### 18. Kalkulator Yuran Kelas (`/admin/calculator-fee`)

**Page:** `CalculatorFee`

**Purpose:** Fee calculation tool

**Access Permission:** `view_any_calculator_fee`

---

### 19. Prestasi Pelajar (`/admin/record-student`)

**Page:** `RecordStudent`

**Purpose:** Student performance records

**Access Permission:** `view_any_record_student`

---

### 20. Butiran Pelajar (`/admin/student-info`)

**Page:** `StudentInfo`

**Purpose:** Student details

**Access Permission:** `view_any_student_info`

---

### 21. Invois Yuran (`/admin/invoices`) - Hidden

**Page:** `Invoices`

**Livewire Component:** `InvoiceView`

**Purpose:** Invoice viewing page

**Data:** ReportClass record by ID query parameter

---

## DASHBOARD WIDGETS

### StatsOverview (Teacher)
**Location:** `app/Filament/Widgets/StatsOverview.php`

| Stat | Description |
|------|-------------|
| Allowance Month 12/25 | Teacher allowance for December 2025 (formatted MYR) |
| Active Clients | Count of active clients in last 3 months |

---

### AdminStats
**Location:** `app/Filament/Widgets/AdminStats.php`

| Stat | Description |
|------|-------------|
| Total Fee December 2025 | All fees for December 2025 |
| Total Allowance December 2025 | All teacher allowances |
| Overdue Balance December 2025 | Total unpaid fees |

---

### ClientStats
**Location:** `app/Filament/Widgets/ClientStats.php`

| Stat | Description |
|------|-------------|
| Total Fee December 2025 | Fees for current client |
| Overdue Balance | Unpaid fees for current client |

---

## DATA MODELS

### User
**Fields:** name, phone, email, password, code, avatar_url

**Relationships:** Belongs to Many Role (Spatie Permission)

**Interfaces:** FilamentUser, HasAvatar

---

### Student
**Fields:** student_id, registrar_id, code, age_stage, note

**Relationships:**
- Belongs to User (student)
- Belongs to Registrar (registrar)

---

### Teacher
**Fields:** teacher_id, code, phone, address, position, sex, bank_name, account_bank, resume (media)

**Relationships:** Belongs to User (teacher)

---

### Registrar
**Fields:** code, phone, address, registrar_id

**Relationships:** Belongs to User (registrar)

---

### ClassName
**Fields:** name, feeperhour, allowanceperhour

**Relationships:**
- Belongs to Many AssignClassTeacher
- Belongs to Many ClassPackage

---

### ClassPackage
**Fields:** name, batch

**Relationships:** Belongs to Many AssignClassTeacher

---

### AssignClassTeacher
**Fields:** teacher_id, registrar_id, assign_class_code, classpackage_id, class_id

**Relationships:**
- Belongs to User (teacher)
- Belongs to User (registrar)
- Belongs to Many ClassName (classes)
- Belongs to Many ClassPackage (classpackage)

---

### ReportClass
**Fields:**
- registrar_id (client)
- class_names_id (primary class)
- date (JSON array of dates)
- total_hour
- class_names_id_2 (secondary class)
- date_2 (JSON)
- total_hour_2
- month
- allowance
- record_student
- created_by_id (teacher)
- fee_student
- status (payment status)
- note
- receipt (file)
- allowance_note

**Relationships:**
- Belongs to ClassName (class_name)
- Belongs to ClassName (class_name_2)
- Belongs to User (registrar)
- Belongs to User (created_by)

**Accessors/Mutators:** JSON date handling for date and date_2 fields

---

### FeeRate
**Fields:** class_names_id, total_hours_min, total_hours_max, feeperhour

**Relationship:** Belongs to ClassName

---

### Invoice
**Fields:** student, registrar, teacher, class, total_hour, amount_fee, date_class, fee_perhour

---

### HistoryPayment
**Fields:** amount_paid, receipt_paid, paid_by_id

**Relationship:** Belongs to User (paidby)

---

### Debt
**Fields:** name, description, amount

---

### Income
**Fields:** income_category_id, entry_date, amount, description

**Relationship:** Belongs to IncomeCategory

---

### Expense
**Fields:** expense_category_id, entry_date, amount, description

**Relationship:** Belongs to ExpenseCategory

---

### Claim
**Fields:** name, image, amount

---

### RegisterClass
**Fields:** code_class, class_type_id, class_name_id, class_package_id, class_numer_id

**Relationships:**
- Belongs to ClassType
- Belongs to ClassName
- Belongs to ClassPackage
- Belongs to ClassNumber
- HasOne ReportClass

---

## USER ROLES REFERENCE

| Role ID | Name | Access Level |
|---------|------|--------------|
| 1 | Admin | Full access to all pages |
| 2 | Teacher | Teacher pages, their classes, their fees, their allowance |
| 3 | Staff | Not fully configured |
| 4 | Client/Registrar | Client pages, their classes, their fees, their transactions |

---

## PAYMENT STATUS REFERENCE

| Status | Label | Color | Description |
|--------|-------|-------|-------------|
| 0 | Belum Bayar | danger (red) | Not paid |
| 1 | Dah Bayar | success (green) | Paid |
| 2 | Dalam Proses Transaksi | primary (blue) | Payment in transaction |
| 3 | Gagal Bayar | info (light blue) | Payment failed |
| 4 | Dalam Proses | gray | Currently processing |
| 5 | Yuran Terlebih | warning (yellow) | Overpaid |

---

## ALLOWANCE STATUS REFERENCE

| Status | Label | Color |
|--------|-------|-------|
| dah_bayar | Dah Bayar | success (green) |
| belum_bayar | Belum Bayar | danger (red) |
| NULL | Tiada Data | gray |

---

## KEY RELATIONSHIPS DIAGRAM

```
User (Role-based)
├── Teacher (Role 2)
│   └── AssignClassTeacher (teacher_id)
│       ├── Classes (many-to-many via ClassName)
│       └── ClassPackage (many-to-many)
│
├── Client/Registrar (Role 4)
│   └── AssignClassTeacher (registrar_id)
│       ├── Classes (many-to-many via ClassName)
│       └── ClassPackage (many-to-many)
│
└── Admin (Role 1)
    └── Can view all

ReportClass
├── Belongs to User (created_by - teacher)
├── Belongs to User (registrar - client)
├── Belongs to ClassName (class_name - primary)
└── Belongs to ClassName (class_name_2 - secondary)

ClassName
└── Belongs to Many AssignClassTeacher

ClassPackage
└── Belongs to Many AssignClassTeacher
```

---

## QUICK REFERENCE: PAGE URLs

| Page | URL | Role |
|------|-----|------|
| Dashboard | `/admin` | Admin |
| Users | `/admin/users` | Admin |
| Assign Class | `/admin/assign-class-teachers` | Admin |
| Class Names | `/admin/class-names` | Admin |
| Class Packages | `/admin/class-packages` | Admin |
| Fee Rates | `/admin/fee-rates` | Admin |
| Report Classes | `/admin/report-classes` | Admin |
| Teacher Classes | `/teacher/your-class` | Teacher |
| Student Fees | `/teacher/fee-student` | Teacher |
| Teacher Allowance | `/teacher/allowance` | Teacher |
| Info/Memo | `/teacher/info` | Teacher |
| My Clients | `/client/my-clients` | Client |
| Client Classes | `/client/client-class` | Client |
| Monthly Fee | `/client/monthly-fee` | Client |
| Transactions | `/client/transaction` | Client |
| Overdue Payments | `/admin/overdue-pay-list` | Admin |
