method = post
prefix = tx_form
confirmation = 1
postProcessor {
    1 = WebVision\WvFormDbInsert\Form\PostProcessor\HashInput
    1 {
        fields = password
    }

    2 = WebVision\WvFormDbInsert\Form\PostProcessor\DbInsert
    2 {
        tableName = fe_users
        columns {
            pid = 55
            disable = 1
        }
    }

    4 = mail
    4 {
        recipientEmail = testing@daniel-siepmann.de
        senderEmail = website@daniel-siepmann.de
        subject = New Registration
        messages.success = Your registration will be checked. You receive another mail once you are approved.
    }
}
10 = TEXTLINE
10 {
    type = text
    name = company
    required = required
    label {
        value = Company
    }
}
20 = SELECT
20 {
    name = title
    required = required
    size = 1
    label {
        value = Title
    }
    10 = OPTION
    10 {
        text = Mr.
        value = mr
    }
    20 = OPTION
    20 {
        text = Mrs.
        value = mrs
    }
}
30 = TEXTLINE
30 {
    type = text
    name = first_name
    required = required
    label {
        value = Name
    }
}
40 = TEXTLINE
40 {
    type = text
    name = last_name
    required = required
    label {
        value = Surname
    }
}
50 = TEXTLINE
50 {
    type = text
    name = city
    required = required
    label {
        value = City
    }
}
60 = TEXTLINE
60 {
    type = text
    name = country
    required = required
    label {
        value = Country
    }
}
70 = TEXTLINE
70 {
    type = text
    name = telephone
    required = required
    label {
        value = Phone
    }
}
80 = TEXTLINE
80 {
    type = email
    name = username
    required = required
    label {
        value = Email
    }
}
90 = PASSWORD
90 {
    type = password
    autocomplete = off
    name = password
    required = required
    label {
        value = Passwort
    }
}
100 = SUBMIT
100 {
    type = submit
    name = 10
    value = Register
}
rules {
    1 = required
    1 {
        showMessage = 1
        message = *
        error = This field is required
        element = company
    }
    2 = required
    2 {
        showMessage = 1
        message = *
        error = This field is required
        element = title
    }
    3 = required
    3 {
        showMessage = 1
        message = *
        error = This field is required
        element = first_name
    }
    4 = required
    4 {
        showMessage = 1
        message = *
        error = This field is required
        element = last_name
    }
    5 = required
    5 {
        showMessage = 1
        message = *
        error = Dies ist ein Pflichtfeld.
        element = city
    }
    6 = required
    6 {
        showMessage = 1
        message = *
        error = This field is required
        element = country
    }
    7 = required
    7 {
        showMessage = 1
        message = *
        error = Dies ist ein Pflichtfeld.
        element = telephone
    }
    8 = required
    8 {
        showMessage = 1
        message = *
        error = This field is required
        element = username
    }
    9 = email
    9 {
        showMessage = 
        message = name@domain.de
        error = Please provide a valid E-Mail.
        element = username
    }
    10 = regexp
    10 {
        showMessage = 1
        message = 
        error = Min. 1 Upper- & lowercase, 1 digit 1 specialchar ($_=@$!%*?&)
        expression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$_=@$!%*?&])[A-Za-z\d$_=@$!%*?&]{8,}/
        element = password
    }
    11 = required
    11 {
        showMessage = 1
        message = *
        error = This field is required
        element = password
    }
}
