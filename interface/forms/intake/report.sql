SELECT
    pd.pid as "Client ID",
    concat(u.fname , ' ' , u.lname,  ) as 'Therapist Billed',
    concat(users.fname, ' ', users.lname ) as 'Therapist',
    date_format(fe.date, '%Y-%m-%d') as 'Date',
    pd.fname as 'Client First Name',
    pd.lname as 'Client Last Name',
    primary_insurance_company.name AS 'Insurance',
    secondary_insurance_company.name AS 'Secondary Insurance',
    opc.pc_catname as "Session Type",
    lo.option_id as "Location",
    date_format(fe.date, '%h:%i %p') as "Time In",
    date_format(fe.endTime, '%h:%i %p') as "Time Out"
FROM form_encounter fe
         JOIN patient_data pd ON pd.pid = fe.pid
         JOIN users u ON u.id = fe.provider_id
         JOIN openemr_postcalendar_categories opc ON opc.pc_catid = fe.pc_catid
         join forms f on f.encounter = fe.encounter and form_name like  "%New Patient%"
         left join list_options lo on substring(fe.pos_code, 1, 2) = substring(lo.title, 1, 2) and lo.list_id = "Location_Code"
         LEFT JOIN insurance_data primary_insurance ON pd.pid = primary_insurance.pid AND primary_insurance.type = 'primary'
         LEFT JOIN insurance_data secondary_insurance ON pd.pid = secondary_insurance.pid AND secondary_insurance.type = 'secondary'
         LEFT JOIN insurance_companies primary_insurance_company ON primary_insurance.provider = primary_insurance_company.id
         LEFT JOIN insurance_companies secondary_insurance_company ON secondary_insurance.provider = secondary_insurance_company.id
         JOIN users ON f.user = users.username
WHERE date_format(fe.date, '%Y-%m-%d')  >= '2023-03-15' AND date_format(fe.date, '%Y-%m-%d')  <= '2023-04-01'
  AND (
        primary_insurance.date IS NULL
        OR (
                primary_insurance.date = (
                SELECT MAX(sub_insurance.date)
                FROM insurance_data sub_insurance
                WHERE sub_insurance.pid = primary_insurance.pid
                  AND sub_insurance.type = 'primary'
                  AND sub_insurance.date <= date_format(fe.date, '%Y-%m-%d')
            )
            )
    )
  AND (
        secondary_insurance.date IS NULL
        OR (
                secondary_insurance.date = (
                SELECT MAX(sub_insurance.date)
                FROM insurance_data sub_insurance
                WHERE sub_insurance.pid = secondary_insurance.pid
                  AND sub_insurance.type = 'secondary'
                  AND sub_insurance.date <= fe.date
            )
            )
    );
