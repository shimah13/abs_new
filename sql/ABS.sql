---adding video link in openemr postcalendar events
#IfMissingColumn openemr_postcalendar_events meeting_link
ALTER TABLE openemr_postcalendar_events add column meeting_link text;
#EndIf

---adding zoom users id in users table
#IfMissingColumn users zoom_user_id
ALTER TABLE users add column zoom_user_id text;
#EndIf

---adding video channel in openemr postcalendar events
#IfMissingColumn openemr_postcalendar_events pc_video_channel
ALTER TABLE openemr_postcalendar_events add column pc_video_channel varchar(255);
#EndIf

--Adding categories for group therapy appointment comments
#IfNotRow categories name Group Theraphy Comments
SET @lft = (SELECT rght FROM  categories where id = 1);
SET @id = (SELECT MAX(id) FROM  categories);
INSERT INTO `categories` (`id`,`name`, `parent`, `lft`, `rght`) values(@id+1, 'Group Theraphy Comments', 1, @lft, @lft+1);
UPDATE `categories` set `rght` = @lft+2 where `id` = 1;
#EndIf

--Adding video channels
#IfNotRow2D list_options list_id lists option_id video_channel
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'video_channel', 'Video Channels');
#EndIf

#IfNotRow2D list_options list_id video_channel option_id google
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('video_channel', 'google', 'Google Meet',1);
#EndIf

#IfNotRow2D list_options list_id video_channel option_id zoom
SET @seq = (SELECT MAX(seq) FROM list_options where list_id="video_channel");
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('video_channel', 'zoom', 'Zoom',@seq+1);
#EndIf

--Changing Names of Visit Category
#IfNotRow2D openemr_postcalendar_categories pc_constant_id office_visit pc_catname Family Therapy
UPDATE openemr_postcalendar_categories SET pc_catname='Family Therapy' where pc_constant_id = 'office_visit';
#EndIf

#IfNotRow2D openemr_postcalendar_categories pc_constant_id comlink_telehealth_established_patient pc_catname Individual Session - 45 Min - Telemedicine
UPDATE openemr_postcalendar_categories SET pc_catname='Individual Session - 45 Min - Telemedicine' where pc_constant_id = 'comlink_telehealth_established_patient';
#EndIf

#IfNotRow2D openemr_postcalendar_categories pc_constant_id established_patient pc_catname Family Therapy W/O Patient - Telemedicine
UPDATE openemr_postcalendar_categories SET pc_catname='Family Therapy W/O Patient - Telemedicine' where pc_constant_id = 'established_patient';
#EndIf

#IfNotRow2D openemr_postcalendar_categories pc_constant_id new_patient pc_catname Individual Session - 60 Min - Telemedicine
UPDATE openemr_postcalendar_categories SET pc_catname='Individual Session - 60 Min - Telemedicine' where pc_constant_id = 'new_patient';
#EndIf

#IfNotRow2D openemr_postcalendar_categories pc_constant_id comlink_telehealth_new_patient pc_catname Individual Session - 30 Min - Telemedicine
UPDATE openemr_postcalendar_categories SET pc_catname='Individual Session - 30 Min - Telemedicine' where pc_constant_id='comlink_telehealth_new_patient';
#EndIf

--Remove unwanted visit category
#IfNotRow2D openemr_postcalendar_categories pc_constant_id preventive_care_services pc_active 0 
UPDATE openemr_postcalendar_categories SET pc_active='0' where pc_constant_id = 'preventive_care_services';
#EndIf

#IfNotRow2D openemr_postcalendar_categories pc_constant_id ophthalmological_services pc_active 0
UPDATE openemr_postcalendar_categories SET pc_active='0' where pc_catid='ophthalmological_services';
#EndIf

--Appointment encounter mapping
#IfMissingColumn form_encounter appt_id
ALTER TABLE form_encounter add column appt_id bigint(20);
#EndIf

#IfMissingColumn fee_sheet_options modifier
ALTER TABLE fee_sheet_options add column fs_modifier varchar(12);
#EndIf

-- Adding appointment status for excuess
#IfNotRow2D list_options list_id apptstat option_id excuse
SET @seq = (SELECT MAX(seq) FROM  list_options where list_id = 'apptstat');
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('apptstat', 'excuse', 'Excuse',@seq+1);
#EndIf


--Adding Ethnicity
#IfNotRow2D list_options list_id lists option_id Ethnicity
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'Ethnicity', 'Ethnicity');
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id ame_ind_alaska
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'ame_ind_alaska', 'American Indian or Alaska Native',1);
#EndIf


#IfNotRow2D list_options list_id Ethnicity option_id Asian
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'Asian', 'Asian',2);
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id African
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'African', 'Black or African American',3);
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id Hispanic
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'Hispanic', 'Hispanic or Latino ',4);
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id Pacific
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'Pacific', 'Native Hawaiian or Other Pacific Islander',5);
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id Caucasian
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'Caucasian', 'White/Caucasian',6);
#EndIf

#IfNotRow2D list_options list_id Ethnicity option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Ethnicity', 'other', 'Other',7);
#EndIf


--Adding Religion
#IfNotRow2D list_options list_id lists option_id Religion
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'Religion', 'Religion');
#EndIf

#IfNotRow2D list_options list_id Religion option_id Agnostic
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Agnostic', 'Agnostic',1);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Buddhist
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Buddhist', 'Buddhist',2);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Catholic
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Catholic', 'Catholic',3);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Christian
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Christian', 'Christian',4);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Jewish
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Jewish', 'Jewish',5);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Hindu
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Hindu', 'Hindu',6);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Mormon
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Mormon', 'Mormon',7);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Muslim
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Muslim', 'Muslim',8);
#EndIf

#IfNotRow2D list_options list_id Religion option_id Sikh
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'Sikh', 'Sikh',9);
#EndIf

#IfNotRow2D list_options list_id Religion option_id None
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'None', 'None',10);
#EndIf

#IfNotRow2D list_options list_id Religion option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('Religion', 'other', 'Other',10);
#EndIf

--Adding Religion
#IfNotRow2D list_options list_id lists option_id living_environment
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'living_environment', 'Living Environment');
#EndIf

#IfNotRow2D list_options list_id living_environment option_id private_home
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'private_home', 'Private Home',1);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id apartment
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'apartment', 'Apartment',2);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id room
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'room', 'Room',3);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id sro
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'sro', 'SRO',4);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id 3_quater
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', '3_quater', 'Three quarter house',1);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id half_way
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'half_way', 'Half way house',1);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id Residential
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'Residential', 'Residential Treatment Program',1);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id Shelter
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'Shelter', 'Shelter',1);
#EndIf

#IfNotRow2D list_options list_id living_environment option_id Homeless
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('living_environment', 'Homeless', 'Homeless',1);
#EndIf

#IfNotRow2D list_options list_id lists option_id payment_info
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'payment_info', 'Payment Information');
#EndIf

#IfNotRow2D list_options list_id payment_info option_id self_pay
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('payment_info', 'self_pay', 'Self Pay',1);
#EndIf

#IfNotRow2D list_options list_id payment_info option_id med_insu
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('payment_info', 'med_insu', 'Medical Insurance',2);
#EndIf

#IfNotRow2D list_options list_id payment_info option_id Eap
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('payment_info', 'Eap', 'Eap',3);
#EndIf

#IfNotRow2D list_options list_id payment_info option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('payment_info', 'other', 'Other',4);
#EndIf

--Adding Religion
#IfNotRow2D list_options list_id lists option_id gender
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'gender', 'Gender');
#EndIf

#IfNotRow2D list_options list_id gender option_id male
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gender', 'male', 'Male',1);
#EndIf

#IfNotRow2D list_options list_id gender option_id female
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gender', 'female', 'Female',2);
#EndIf

#IfNotRow2D list_options list_id gender option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gender', 'other', 'Other',3);
#EndIf

#IfNotTable patient_referral_form
CREATE TABLE IF NOT EXISTS `patient_referral_form`(
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
   `groupname` text,
   `user` text,
   `authorized` text,
   `activity` text,
`pid` bigint(20),
`insuranceID` text,
`eap_contact_email` text,
`eap_contact_person` text,
`eap_contact_phone` text,
`eap_med_ins` text,
`eap_session` text,
`eap_voucher` text,
`otherCourtName` text,
`ethnicity` text,  
`religion` text,  
`living_environment` text,  
`apt_number` text,  
`qua_house` text,  
`half_house` text,  
`resident_treat_pgm` text,  
`shelter_name` text, 
`payment_ifo` text, 
`insurance_comapny` text, 
`eap_pgms` text, 
`Who_Referred_You_to_ABS_` text, 
`lawyerDiv_info` text, 
`caseType_info` text, 
`lawyer_attroney_name` text, 
`lawyer_attroney_phone` text, 
`lawyer_attroney_email` text, 
`childwelfare` text, 
`welfare_worker_name` text, 
`welfare_worker_ph` text, 
`welfare_worker_email` text, 
`countyName` text, 
`courtName` text, 
`dmv` text, 
`prob_courtCase` text, 
`prob_offc_name` text, 
`prob_offc_ph` text, 
`prob_offc_email` text, 
`doc_name` text, 
`doc_phone` text, 
`doc_email` text, 
`hospital_name` text, 
`parole_offc_name` text, 
`parole_offc_ph` text, 
`parole_offc_email` text, 
`social_worker_name` text, 
`social_worker_ph` text, 
`social_worker_email` text,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
#EndIf

#IfNotRow2D list_options list_id lists option_id eap_pgms
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'eap_pgms', 'Eap programs');
#EndIf

#IfNotRow2D list_options list_id eap_pgms option_id eap_contact_person
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms', 'eap_contact_person', 'EAP Contact Person',1);
#EndIf

#IfNotRow2D list_options list_id eap_pgms option_id eap_contact_email
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms', 'eap_contact_email', 'EAP Contact Email',2);
#EndIf


#IfNotRow2D list_options list_id eap_pgms option_id eap_contact_phone
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms', 'eap_contact_phone', 'EAP Contact Phone',3);
#EndIf

#IfNotRow2D list_options list_id eap_pgms option_id eap_voucher
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms', 'eap_voucher', 'Authorization reference or voucher number',4);
#EndIf

#IfNotRow2D list_options list_id eap_pgms option_id eap_session
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms', 'eap_session', 'Number of Authorized Sessions',5);
#EndIf

#IfNotRow2D list_options list_id lists option_id eap_pgms_rad
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'eap_pgms_rad', 'Eap programs');
#EndIf

#IfNotRow2D list_options list_id eap_pgms_rad option_id Humana
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms_rad', 'Humana', 'Humana',1);
#EndIf

#IfNotRow2D list_options list_id eap_pgms_rad option_id work_place
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms_rad', 'work_place', 'Work Place',2);
#EndIf

#IfNotRow2D list_options list_id eap_pgms_rad option_id CHAC
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms_rad', 'CHAC', 'CHAC',3);
#EndIf

#IfNotRow2D list_options list_id eap_pgms_rad option_id cigna
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('eap_pgms_rad', 'cigna', 'Cigna / Evernorth',4);
#EndIf

---
#IfNotRow2D list_options list_id lists option_id involved_agencies
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'involved_agencies', 'Eap programs');
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id lawyer
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'lawyer', 'Attorney/Lawyer',1);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id child_welfare
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'child_welfare', 'ACS- CPS-DYFS or Child Welfare Department/Child Protective Services',2);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id court
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'court', 'Court',3);
#EndIf


#IfNotRow2D list_options list_id involved_agencies option_id motor_vehicles
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'motor_vehicles', 'Department of Motor Vehicles',4);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id probation
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'probation', 'Department of Probation',5);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id doctor
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'doctor', 'Doctor/Health Care Worker',6);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id employee
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'employee', 'Employer/Employee Assistance Program',7);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id hospital
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'hospital', 'Hospital',8);
#EndIf

#IfNotRow2D list_options list_id involved_agencies option_id new_york
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'new_york', 'New York Counsel on Problem Gambling',9);
#EndIf  

#IfNotRow2D list_options list_id involved_agencies option_id state_department
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'state_department', 'New York State Department of Corrections and Community Supervision/Parole',10);
#EndIf 

#IfNotRow2D list_options list_id involved_agencies option_id social_worker
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'social_worker', 'Social Worker',11);
#EndIf 

#IfNotRow2D list_options list_id involved_agencies option_id self_referral
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'self_referral', 'Self-Referral',12);
#EndIf 

#IfNotRow2D list_options list_id involved_agencies option_id otehr
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('involved_agencies', 'other', 'Other',13);
#EndIf 

#IfNotRow2D list_options list_id lists option_id dmv
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'dmv', 'DMV');
#EndIf

#IfNotRow2D list_options list_id dmv option_id new_york_state_dept
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('dmv', 'new_york_state_dept', 'New York State Department of Motor Vehicles',1);
#EndIf

#IfNotRow2D list_options list_id dmv option_id new_jercy_state_dept
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('dmv', 'new_jercy_state_dept', 'New Jersey State Department of Motor Vehicles',2);
#EndIf

#IfNotRow2D list_options list_id dmv option_id new_jercy_intoxicated_dept
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('dmv', 'new_jercy_intoxicated_dept', 'New Jersey Intoxicated Driver Resrource Center (IDRC)',3);
#EndIf

---
#IfNotRow2D list_options list_id lists option_id lawyerDiv
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'lawyerDiv', 'Lawyer Div');
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id legal_aid
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'legal_aid', 'The Legal Aid Society',1);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id Brooklyn
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'Brooklyn', 'Brooklyn Defender Services',2);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id newyork_county
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'newyork_county', 'New York County Defender Services',3);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id bronx
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'bronx', 'The Bronx Defenders',4);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id Federal
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'Federal', 'Federal Defenders of New York',5);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id legal_aid_suffolk
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'legal_aid_suffolk', 'Legal Aid Society of Suffolk County',6);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id private_attorney
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'private_attorney', 'Private Attorney',7);
#EndIf

#IfNotRow2D list_options list_id lawyerDiv option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('lawyerDiv', 'other', 'Other',8);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id caseType
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'caseType', 'Case Types');
#EndIf

#IfNotRow2D list_options list_id caseType option_id criminal_case
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('caseType', 'criminal_case', 'Criminal Court Case',1);
#EndIf

#IfNotRow2D list_options list_id caseType option_id family_case
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('caseType', 'family_case', 'Family Court Case',2);
#EndIf

--children welfare
#IfNotRow2D list_options list_id lists option_id child_welfare
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'child_welfare', 'Child welfare');
#EndIf

#IfNotRow2D list_options list_id child_welfare option_id newyork_acs
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'newyork_acs', "New York City Administration For Children's Services (ACS)",1);
#EndIf

#IfNotRow2D list_options list_id child_welfare option_id DYFS
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'DYFS', 'New Jersey Youth And Family Services (DYFS)',2);
#EndIf

#IfNotRow2D list_options list_id child_welfare option_id child_protective
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'child_protective', 'Nassau County Child Protective Services',3);
#EndIf


#IfNotRow2D list_options list_id child_welfare option_id Rockland
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'Rockland', 'Rockland County Child Protective Services',4);
#EndIf


#IfNotRow2D list_options list_id child_welfare option_id social_service_bureau
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'social_service_bureau', 'Suffolk County Department of Social Services Child Protective Services Bureau',5);
#EndIf

#IfNotRow2D list_options list_id child_welfare option_id Westchester
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'Westchester', 'Westchester County Child Protective Services',6);
#EndIf

#IfNotRow2D list_options list_id child_welfare option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('child_welfare', 'other', 'Other',7);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id court_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'court_list', 'Court List');
#EndIf

#IfNotRow2D list_options list_id court_list option_id kings
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'newyork_acs', 'Kings County',1);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Richmond
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Richmond', 'Richmond County',2);
#EndIf

#IfNotRow2D list_options list_id court_list option_id newyork
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'newyork', 'New York County',3);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Queens
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Queens', 'Queens County',4);
#EndIf


#IfNotRow2D list_options list_id court_list option_id Bronx
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Bronx', 'Bronx County',5);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Nassau
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Nassau', 'Nassau County',6);
#EndIf


#IfNotRow2D list_options list_id court_list option_id Suffolk
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Suffolk', 'Suffolk County',7);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Westchester
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Westchester', 'Westchester County',8);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Rockland
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Rockland', 'Rockland County',9);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Hudson
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Hudson', 'Hudson County',10);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Essex
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Essex', 'Essex County',11);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Bergen
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Bergen', 'Bergen County',12);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Union
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Union', 'Union County',13);
#EndIf

#IfNotRow2D list_options list_id court_list option_id Other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('court_list', 'Other', 'Other',14);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id westchester_court_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'westchester_court_list', 'Westchester Court List');
#EndIf

#IfNotRow2D list_options list_id westchester_court_list option_id westchester_court_country
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('westchester_court_list', 'westchester_court_country', 'Westchester County Court',1);
#EndIf

#IfNotRow2D list_options list_id westchester_court_list option_id westchester_court_family
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('westchester_court_list', 'westchester_court_family', 'Family Court of Westchester County',2);
#EndIf

#IfNotRow2D list_options list_id westchester_court_list option_id westchester_court_supreme
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('westchester_court_list', 'westchester_court_supreme', 'Westchester Supreme Court',3);
#EndIf

#IfNotRow2D list_options list_id westchester_court_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('westchester_court_list', 'other', 'Other',4);
#EndIf

--Probation
#IfNotRow2D list_options list_id lists option_id probation_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'probation_list', 'Westchester Court List');
#EndIf

#IfNotRow2D list_options list_id probation_list option_id newyork_prob
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'newyork_prob', 'New York City Department of Probation',1);
#EndIf

#IfNotRow2D list_options list_id probation_list option_id nassau_prob
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'nassau_prob', 'Nassau County Department of Probation',1);
#EndIf

#IfNotRow2D list_options list_id probation_list option_id suffolk_prob
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'suffolk_prob', 'Suffolk County Department of Probation',1);
#EndIf

#IfNotRow2D list_options list_id probation_list option_id rockland_prob
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'rockland_prob', 'Rockland County Department of Probation',1);
#EndIf

#IfNotRow2D list_options list_id probation_list option_id westchester_prob
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'westchester_prob', 'Westchester County Department of Probation',1);
#EndIf

#IfNotRow2D list_options list_id probation_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('probation_list', 'other', 'Other',1);
#EndIf

--therap form
#IfNotRow2D list_options list_id lists option_id therap_support_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'therap_support_list', 'What means of support do you have');
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id employeement
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'employeement', 'Employment',1);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id unemployeement
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'unemployeement', 'Unemployment',2);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id pub_assistance
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'pub_assistance', 'Public Assistance',3);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id ssi_ssd
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'ssi_ssd', 'SSI/SSD',4);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id fam_support
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'fam_support', 'Family Support',5);
#EndIf


#IfNotRow2D list_options list_id therap_support_list option_id pension
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'pension', 'Pension',6);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id retirement
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'retirement', 'Retirement',7);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id social_security
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'social_security', 'Social Security',8);
#EndIf

#IfNotRow2D list_options list_id therap_support_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('therap_support_list', 'other', 'Other',9);
#EndIf

--Education list
#IfNotRow2D list_options list_id lists option_id education_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'education_list', 'Education level list');
#EndIf

#IfNotRow2D list_options list_id education_list option_id primary
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('education_list', 'primary', 'Primary, Elementary or Grade School',1);
#EndIf

#IfNotRow2D list_options list_id education_list option_id high_school
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('education_list', 'high_school', 'High School/GED',2);
#EndIf

#IfNotRow2D list_options list_id education_list option_id some_clg
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('education_list', 'some_clg', 'Some College',3);
#EndIf

#IfNotRow2D list_options list_id education_list option_id college
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('education_list', 'college', 'College',4);
#EndIf

#IfNotRow2D list_options list_id education_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('education_list', 'other', 'Other',5);
#EndIf

--college list
#IfNotRow2D list_options list_id lists option_id college_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'college_list', 'College list');
#EndIf

#IfNotRow2D list_options list_id college_list option_id associates
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('college_list', 'associates', 'Associates',1);
#EndIf

#IfNotRow2D list_options list_id college_list option_id bachelors
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('college_list', 'bachelors', 'Bachelors',2);
#EndIf

#IfNotRow2D list_options list_id college_list option_id masters
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('college_list', 'masters', 'Masters',3);
#EndIf

#IfNotRow2D list_options list_id college_list option_id doctorate
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('college_list', 'doctorate', 'Doctorate',4);
#EndIf

--relationship

#IfNotRow2D list_options list_id lists option_id fam_relationship_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'fam_relationship_list', 'Family Relationship Status');
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id Divorced
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'Divorced', 'Divorced',1);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id Widowed
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'Widowed', 'Widowed',2);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id newver_married
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'newver_married', 'Never Married',3);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id currently_married
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'currently_married', 'Currently Married',4);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id single_never_married
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'single_never_married', 'Single + never married',5);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id single_never_married
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'in_relationship', 'In a relationship',6);
#EndIf

#IfNotRow2D list_options list_id fam_relationship_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fam_relationship_list', 'other', 'Other',7);
#EndIf

#IfNotRow2D list_options list_id lists option_id who_live_with
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'who_live_with', 'Who do you live with');
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id live_alone
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'live_alone', 'I live alone',1);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id parents
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'parents', 'Parents',2);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id Roommates
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'Roommates', 'Roommates',3);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id Friends
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'Friends', 'Friends',4);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id fam_mem
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'fam_mem', 'Family Members',5);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id my_step_child
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'my_step_child', 'My Children/Step Children',6);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id Spouse
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'Spouse', 'Spouse/Significant Other',7);
#EndIf

#IfNotRow2D list_options list_id who_live_with option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('who_live_with', 'other', 'Other',8);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id how_many_children
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'how_many_children', 'How many children/step children do you have in total');
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 0
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '0', '0',1);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 1
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '1', '1',2);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 2
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '2', '2',3);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 3
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '3', '3',4);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 4
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '4', '4',5);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 5
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '5', '5',6);
#EndIf

#IfNotRow2D list_options list_id how_many_children option_id 6
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_children', '6', '6+',7);
#EndIf


--custody list
#IfNotRow2D list_options list_id lists option_id custody_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'custody_list', 'Custody list');
#EndIf

#IfNotRow2D list_options list_id custody_list option_id live_me
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'live_me', 'Lives with me',1);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id other_parent
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'other_parent', 'Other parent',2);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id grand_parent
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'grand_parent', 'Grandparent',3);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id other_fam_mem
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'other_fam_mem', 'Other family member',4);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id Relative
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'Relative', 'Relative',5);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id Kinship
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'Kinship', 'Kinship',6);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id Foster
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'Foster', 'Foster care',7);
#EndIf

#IfNotRow2D list_options list_id custody_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('custody_list', 'other', 'Other',8);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id being_referred_to
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'being_referred_to', 'What ABS program(s) are you interested in or being referred to');
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id anger_mgmt
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'anger_mgmt', 'Anger Management and Stabilization Program',1);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id violence_prevention
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'violence_prevention', 'Violence Prevention and Intervention Program',2);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id addiction_rehabit
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'addiction_rehabit', 'Addictions Rehabilitation Program',3);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id drunk_drive
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'drunk_drive', 'Drunk Driving Counseling Program',4);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id sex_behav
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'sex_behav', 'Sexual Behavior Program',5);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id high_council
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'high_council', 'High Profile Counseling Program',6);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id gam_treat
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'gam_treat', 'Gambling Treatment Program',7);
#EndIf


#IfNotRow2D list_options list_id being_referred_to option_id gen_mental_health
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'gen_mental_health', 'General mental health',8);
#EndIf


#IfNotRow2D list_options list_id being_referred_to option_id support_parent
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'support_parent', 'Supportive parenting counseling program',9);
#EndIf

#IfNotRow2D list_options list_id being_referred_to option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_to', 'other', 'Other',10);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id being_referred_for_service
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'being_referred_for_service', 'What are the reasons you are being referred for services');
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id anger_mgmt
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'anger_mgmt', 'Anger Management',1);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id alcohol_drug
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'alcohol_drug', 'Alcohol or Drug Abuse',2);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id dwi_dui
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'dwi_dui', 'DWI/DUI',3);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id gen_men_health
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'gen_men_health', 'General Mental Health',4);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id gam_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'gam_pblm', 'Gambling Problem',5);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id sex_behav
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'sex_behav', 'Sexual Behavior',6);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id domestic_violence
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'domestic_violence', 'Domestic Violence',7);
#EndIf


#IfNotRow2D list_options list_id being_referred_for_service option_id parent_issue
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'parent_issue', 'Parenting Issues',8);
#EndIf


#IfNotRow2D list_options list_id being_referred_for_service option_id non_checm_addiction
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'non_checm_addiction', 'Non-chemical addiction',9);
#EndIf

#IfNotRow2D list_options list_id being_referred_for_service option_id conflict_resolution
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'conflict_resolution', 'Conflict resolution',10);
#EndIf


#IfNotRow2D list_options list_id being_referred_for_service option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('being_referred_for_service', 'other', 'Other',11);
#EndIf


--
#IfNotRow2D list_options list_id lists option_id argument_domestic_dispute_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'argument_domestic_dispute_list', 'When was the last time you were in an argument or domestic dispute');
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id today
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'today', 'Today',1);
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id this_week
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'this_week', 'This week',2);
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id week_ago
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'week_ago', 'A week ago',3);
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id month_ago
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'month_ago', 'A month ago',4);
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id year_ago
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'year_ago', 'Over a year ago',5);
#EndIf

#IfNotRow2D list_options list_id argument_domestic_dispute_list option_id never
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('argument_domestic_dispute_list', 'never', 'Never',6);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id anger_or_agression_caused
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'anger_or_agression_caused', 'When was the last time you were in an argument or domestic dispute');
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id legal_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'legal_pblm', 'Legal problems such as arrests, divorce, lawsuits, orders of protection',1);
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id family_relationship_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'family_relationship_pblm', 'Family and relationship problems such as breakups, separations, divorce, custody battles, removal of children',2);
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id financial_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'financial_pblm', 'Financial problems such as legal fees, counseling fees, loss of earnings, spending of savings, law suits',3);
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id employeement_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'employeement_pblm', 'Employment problems such as the loss of job, loss of professional or business license or career, suspended from work or disciplined on the job',4);
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id house_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'house_pblm', 'Housing problems such as eviction, homelessness, stay away orders remover of children',5);
#EndIf

#IfNotRow2D list_options list_id anger_or_agression_caused option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('anger_or_agression_caused', 'other', 'Other',6);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id fighting_with
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'fighting_with', 'Who were you fighting with?');
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id Stranger
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'Stranger', 'Stranger',1);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id family_mem
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'family_mem', 'Family member',2);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id significant_other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'significant_other', 'Significant other',3);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id Friend
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'Friend', 'Friend',4);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id co_worker
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'co_worker', 'Co-worker',5);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id landlord
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'landlord', 'landlord',6);
#EndIf

#IfNotRow2D list_options list_id fighting_with option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('fighting_with', 'other', 'Other',7);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id drug_consumption_duration
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'drug_consumption_duration', 'How often do you have a drink containing alcohol?');
#EndIf

#IfNotRow2D list_options list_id drug_consumption_duration option_id Never
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_consumption_duration', 'Never', 'Never',1);
#EndIf

#IfNotRow2D list_options list_id drug_consumption_duration option_id monthly
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_consumption_duration', 'monthly', 'Monthly or less',2);
#EndIf

#IfNotRow2D list_options list_id drug_consumption_duration option_id 2_4_month
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_consumption_duration', '2_4_month', '2-4 times a month',3);
#EndIf

#IfNotRow2D list_options list_id drug_consumption_duration option_id 2_3_week
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_consumption_duration', '2_3_week', '2-3 times a week',4);
#EndIf

#IfNotRow2D list_options list_id drug_consumption_duration option_id 4_more_week
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_consumption_duration', '4_more_week', '4 or more times a week',5);
#EndIf
--
#IfNotRow2D list_options list_id lists option_id std_drink_contain_alcohol
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'std_drink_contain_alcohol', 'How many standard drinks containing alcohol do you have on a typical day when drinking?');
#EndIf

#IfNotRow2D list_options list_id std_drink_contain_alcohol option_id 1_2
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('std_drink_contain_alcohol', '1_2', '1 or 2',1);
#EndIf

#IfNotRow2D list_options list_id std_drink_contain_alcohol option_id 3_4
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('std_drink_contain_alcohol', '3_4', '3 or 4',2);
#EndIf

#IfNotRow2D list_options list_id std_drink_contain_alcohol option_id 5_6
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('std_drink_contain_alcohol', '5_6', '5 or 6',3);
#EndIf

#IfNotRow2D list_options list_id std_drink_contain_alcohol option_id 7_9
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('std_drink_contain_alcohol', '7_9', '7 to 9',4);
#EndIf

#IfNotRow2D list_options list_id std_drink_contain_alcohol option_id 10_more
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('std_drink_contain_alcohol', '10_more', '10 or more',5);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id how_often_drink
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'how_often_drink', 'How often do you have six or more drinks on one occasion');
#EndIf

#IfNotRow2D list_options list_id how_often_drink option_id Never
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_often_drink', 'Never', 'Never',1);
#EndIf

#IfNotRow2D list_options list_id how_often_drink option_id less_than_monthly
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_often_drink', 'less_than_monthly', 'Less than monthly',2);
#EndIf

#IfNotRow2D list_options list_id how_often_drink option_id Monthly
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_often_drink', 'Monthly', 'Monthly',3);
#EndIf

#IfNotRow2D list_options list_id how_often_drink option_id Weekly
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_often_drink', 'Weekly', 'Weekly',4);
#EndIf

#IfNotRow2D list_options list_id how_often_drink option_id daily
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_often_drink', 'daily', 'Daily or almost daily',5);
#EndIf
--
#IfNotRow2D list_options list_id lists option_id drug_choices
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'drug_choices', 'What are your drugs of choice? Please list all.');
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Alcohol
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Alcohol', 'Alcohol',1);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Marijuana
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Marijuana', 'Marijuana',2);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Cocaine
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Cocaine', 'Cocaine',3);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Opioids
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Opioids', 'Opioids',4);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Halloucinegens
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Halloucinegens', 'Halloucinegens',5);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id PCP
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'PCP', 'PCP',6);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id Steroids
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'Steroids', 'Steroids',7);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id syn_drugs
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'syn_drugs', 'Synthetic Drugs',8);
#EndIf

#IfNotRow2D list_options list_id drug_choices option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('drug_choices', 'other', 'Other',9);
#EndIf

#IfNotRow2D list_options list_id lists option_id gam_pblm_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'gam_pblm_list', 'Gambling - Please check all that apply');
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id spend_lots_gam
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'spend_lots_gam', 'Do you spend lots of time thinking about gambling or planning a gambling activity?',1);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id incre_amount_money
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'incre_amount_money', 'Do you need to gamble with increasing amounts of money to feel excited?',2);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id unsuccessfully
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'unsuccessfully', 'Do you unsuccessfully try to cut back on your gambling?',3);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id feel_anxious
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'feel_anxious', 'Do you ever feel anxious, sad, or guilty about your gambling behaviors?',4);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id ask_other_bail
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'ask_other_bail', 'Do you have to ask others to bail you out of financial troubles due to gambling?',5);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id illegal
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'illegal', 'Do you steal or engage in other illegal activities to retrieve gambling money?',6);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id gam_interface
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'gam_interface', 'Has gambling interfered with your work, school, or relationships?',7);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id lie_to_loved
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'lie_to_loved', 'Do you lie to loved ones about your gambling habits?',8);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id feel_irritable
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'feel_irritable', 'Do you feel irritable or restless when you try to limit your gambling?',9);
#EndIf

#IfNotRow2D list_options list_id gam_pblm_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('gam_pblm_list', 'other', 'Other',10);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id impulsive_sex_behave
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'impulsive_sex_behave', 'Have you ever had any other problems in your life as a result of impulsive sexual behavior such as the following?');
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id sex_transmit_disease
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'sex_transmit_disease', 'Sexually transmitted disease',1);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id unplan_pregnancy
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'unplan_pregnancy', 'Unplanned or unwanted pregnancy',2);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id child_wedlock
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'child_wedlock', 'Child out of wedlock',3);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id mul_child_parent
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'mul_child_parent', 'Multiple children with multiple partners',4);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id loss_frdship_lack_sleep
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'loss_frdship_lack_sleep', "Loss of friendship due to sleeping with friend's partner",5);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id loss_frdship_lack_trust
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'loss_frdship_lack_trust', 'Loss of friendship due to lack of trust or respect related to sexual behavior',6);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id legal_pblm_arrest
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'legal_pblm_arrest', 'Legal problems such as arrests, divorce, lawsuit, orders of protection',7);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id frd_fam_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'frd_fam_pblm', 'Family and relationships problems such as breakups, separations, divorce, custody battles, removal of children due to infidelity or sexual behavior',8);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id financial_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'financial_pblm', 'Financial problems such as legal fees, counseling fees, loss of earnings, spending of savings, law suits',9);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id emp_problem
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'emp_problem', 'Employment problems such as the loss of job, loss of professional or business license or career, suspended from work or disciplined on the job',10);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id house_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'house_pblm', 'Housing problems such as eviction, homelessness, stay away orders , remover of children',11);
#EndIf

#IfNotRow2D list_options list_id impulsive_sex_behave option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('impulsive_sex_behave', 'other', 'Other',12);
#EndIf
--
#IfNotRow2D list_options list_id lists option_id domestic_violence_list
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'domestic_violence_list', 'Has impulsive anger or aggression caused you other problems in your life?');
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id legal_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'legal_pblm', 'Legal problems such as arrests, divorce, lawsuits, orders of protection',1);
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id family_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'family_pblm', 'Family and relationship problems such as breakups, separations, divorce, custody battles, removal of children',2);
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id financial_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'financial_pblm', 'Financial problems such as legal fees, counseling fees, loss of earnings, spending of savings, law suits',3);
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id emp_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'emp_pblm', 'Employment problems such as the loss of job, loss of professional or business license or career, suspended from work or disciplined on the job',4);
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id housing_pblm
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'housing_pblm', 'Housing problems such as eviction, homelessness, stay away orders remover of children',5);
#EndIf

#IfNotRow2D list_options list_id domestic_violence_list option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('domestic_violence_list', 'other', 'Other',6);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id how_many_arrest
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'how_many_arrest', 'How many times have you been arrested?');
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 1
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '1', '1',1);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 2
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '2', '2',2);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 3
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '3', '3',3);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 4
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '4', '4',4);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 5_10
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '5_10', '5-10',5);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 11_20
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '11_20', '11-20',6);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 21_30
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '21_30', '21-30',7);
#EndIf

#IfNotRow2D list_options list_id how_many_arrest option_id 31
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('how_many_arrest', '31', '31+',8);
#EndIf

--
#IfNotRow2D list_options list_id lists option_id menatl_health_concern
INSERT INTO `list_options` ( `list_id`, `option_id`, `title` ) VALUES ('lists', 'menatl_health_concern', 'What is your primary mental health concern?');
#EndIf

#IfNotRow2D list_options list_id menatl_health_concern option_id Anxiety
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('menatl_health_concern', 'Anxiety', 'Anxiety/Stress/Panic',1);
#EndIf

#IfNotRow2D list_options list_id menatl_health_concern option_id ptsd
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('menatl_health_concern', 'ptsd', 'PTSD/Trauma',2);
#EndIf

#IfNotRow2D list_options list_id menatl_health_concern option_id Depression
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('menatl_health_concern', 'Depression', 'Depression',3);
#EndIf

#IfNotRow2D list_options list_id menatl_health_concern option_id Bereavement
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('menatl_health_concern', 'Bereavement', 'Bereavement',4);
#EndIf

#IfNotRow2D list_options list_id menatl_health_concern option_id other
INSERT INTO list_options ( list_id, option_id, title, seq) VALUES ('menatl_health_concern', 'other', 'Other',5);
#EndIf

#IfNotTable patient_therapeutic_form
CREATE TABLE IF NOT EXISTS `patient_therapeutic_form`(
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
   `groupname` text,
   `user` text,
   `authorized` text,
   `activity` text,
`pid` bigint(20),
`therapSupportList` text,
`career` text,
`work_position` text,
`work_exp` text,
`how_long` text,
`how_long_unemployeed` text,
`reason_unemployee` text,
`receiving_assistance` text,
`ssi_ssd` text,
`family_support` text,
`education_level_list` text,
`college_list` text,
`fam_relationship_list` text,
`how_many_married` text,
`ex_partner_name` text,
`spouse_name` text,
`last_relationship` text,
`who_live_with` text,
`how_many_children` text,
`fam_mem_willing_part` text,
`fam_mem_part_name` text,
`fam_mem_part_relation` text,
`fam_mem_part_ph` text,
`fam_sub_abuse` text,
`sub_abuse_explanation` text,
`primary_care_doc` text,
`pri_doc_name` text,
`pri_doc_ph` text,
`curr_health` text,
`surgeries_details` text,
`med_condition_details` text,
`curr_pres_med` text,
`curr_pre_med_details` text,
`do_you_take_med_as_pres` text,
`do_you_take_med_as_pres_details` text,
`recent_hospitalization` text,
`other_health_concern_details` text,
`being_referred_to` text,
`being_referred_for_service` text,
`physical_confrontation` text,
`fighting_with` text,
`physically_hurt` text,
`injurySusDetail` text,
`arrested_violent_crime` text,
`anger_or_agression_caused` text,
`dring_contain_alc` text,
`when_drink_drings` text,
`occasional_drinks` text,
`how_often_stop_drink` text,
`how_often_failed_stop_drink` text,
`how_often_need_drink` text,
`remorse_after_drink` text,
`unable_remember_night_session` text,
`injured_result_drink` text,
`concerned_about_drink` text,
`drugs_of_chioces` text,
`first_time_used` text,
`height_of_usage` text,
`ever_been_in_alcohol` text,
`how_drink_drive_offence` text,
`drug_treat_before_ever` text,
`gamList` text,
`sex_active` text,
`sex_preference` text,
`satisfied_sex_identity` text,
`charged_sex_crime` text,
`impulsive_sex_behave` text,
`domestic_violence` text,
`phy_confrintation` text,
`phy_hurt` text,
`ever_arrested_violent_crime` text,
`domestic_violence_list` text,
`explain_parenting_issue` text,
`non_chemical_addiction` text,
`Intake_suicide` text,
`felt_inclined_harm` text,
`arrested_ever` text,
`how_many_arrest` text,
`monitor_agency` text,
`sentence_length` text,
`incarcerated` text,
`incarcerated_length` text,
`incarcerated_years` text,
`protection_orders` text,
`state_registry` text,
`state_registry_list` text,
`sex_offender` text,
`exp_ver_phy_abuse` text,
`Intake_Victim` text,
`explain_victim` text,
`mental_health_treat` text,
`mentalHealthCondition` text,
`mentalHealthTreatment` text,
`inpatient_treatment_consist` text,
`date_treat_outputpatient` text,
`outpatient_treatment` text,
`therapist_doc` text,
`prescribed_medication` text,
`name_pgm_last_treat` text,
`day_treat_name` text,
`explain_primary_mentalHealth` text,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
#EndIf


