import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { ApiService } from '../../services/api/api.service';
import { loginModel } from '../../models/login.interface';
import { responseLoginModel } from '../../models/response.interface';

import { Router } from '@angular/router';
import { StudentComponent } from '../student/student.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent implements OnInit {
  errorStatus : boolean = false;
  errorMessage : string = "";

  loginForm = new FormGroup({
    username : new FormControl('', Validators.required),
    password : new FormControl('', Validators.required)
  })

  constructor(
    private api : ApiService,
    private router: Router
  ) {
    
   }

  ngOnInit(): void {
      this.checkLocalStorage();
  }

  checkLocalStorage() {
    if (localStorage.getItem("token")) {
      this.router.navigate(["student"]);
    }
  }

  //NO modificar form:any
  submitLogin(form : any) {
    this.api.loginByUsername(form).subscribe(data => {
      let dataLogin : responseLoginModel = data;
      if (dataLogin.result == "ok") {
        localStorage.setItem("token",dataLogin.token);
        this.router.navigate(['student']);
      } else {
        this.errorStatus = true;
        this.errorMessage = dataLogin.details;
      }
    }); 
  }  
}
