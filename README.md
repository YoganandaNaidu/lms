LMS - Loan Management System

Laravel framework version: v6.0

About application: This is a simple loan management system where it consists of following modules:  
1. LoanTypes 
2. LoanPlans
3. Borrowers 
4. Loan
5. LoanCalculation
6. Repayment


Installation: after downloading from github, run following command.  

>composer install

>php artisan migrate

Following are the APIs for module: Loan Type:
_____________________________________________________________________
### Request - Create

>POST /loantypes
>curl -i -H 'Accept: application/json' -d 'type=sampletext&description=sample text'
> <http://<domain>/lms/public/api/loantypes?type=sampletext&description=sample text>

### Response
{
    "message": "Loan type record created"
}
_____________________________________________________________________

### Request - Get All Loans

>GET /loantypes
>curl -i -H 'Accept: application/json' -d
> <http://<domain>/lms/public/api/loantypes>

### Response
[
    {
        "id": 1,
        "type": "corporate loan",
        "description": "for company",
    },
    {
        .....
    },
    {
        .....
    }
]
_____________________________________________________________________
### Request - Get Loan

>GET /loantypes/:id
>curl -i -H 'Accept: application/json' -d
> <http://<domain>/lms/public/api/loantypes>

### Response
[
    {
        "id": 1,
        "type": "corporate loan",
        "description": "for company",
    }
]
_____________________________________________________________________
### Request - Update Loan

>PUT /loantypes/:id
>curl -i -H 'Accept: application/json' -d 'type=sample text&description=sample text'
> <http://<domain>/lms/public/api/loantypes/6?type=sample text&description=sample text>

### Response
{
    "message": "records updated successfully!.."
}
_____________________________________________________________________

I'm avoiding documenting all the APIs request & response as the format is similar for remaining modules. 
1. Loan Plan
2. Borrower
3. Loan
4. payments
_____________________________________________________________________
### Request - Loan Calculation

>GET /loancalc/:id
>curl -i -H 'Accept: application/json' -d
> <http://<domain>/lms/public/api/loancalc/1>

### Response
{
    "id": "1",
    "ref_no": "222222",
    "months": 36,
    "interest": "8.00",
    "penality_rate": "3.00",
    "amount": 100000,
    "total_payable_amount": "108,000.00",
    "monthly_payable_amount": "3,000.00",
    "penalty_amount": "90.00"
}