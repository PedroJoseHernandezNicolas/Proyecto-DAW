import { Injectable } from '@angular/core';
import { loginModel } from '../../models/login.interface';
import { responseLoginModel } from '../../models/response.interface';
import { studentModel } from '../../models/student.interface';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from "rxjs";
import { responseStudentModel } from '../../models/responseStudent.interface';

@Injectable({
  providedIn: 'root'
})

export class ApiService {


  url : string = "http://localhost/DWES/Proyecto/";

  constructor(
    private http:HttpClient
  ) { }

  loginByUsername (form : loginModel) : Observable<responseLoginModel> {
    let endpoint = this.url + "loginCURL.php";
    return this.http.post<responseLoginModel>(endpoint,JSON.stringify(form));
  }

  getStudent() : Observable<responseStudentModel> {
    
    let token = localStorage.getItem("token");
    let expediente = '1234568';

    /*
    const headerCommands = { 
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Access-Control-Allow-Origin' : '*',
      'Access-Control-Allow-Methods' : 'GET,POST,PUT,DELETE,OPTIONS',
      'Access-Control-Allow-Headers' : 'Content-Type,,Authorization,X-Requested-With',
      'Access-Control-Allow-Credentials' : 'true',
    }

    const requestOptions = {
      headers : new HttpHeaders (headerCommands),
    };*/

    let endpoint = this.url + "alumnoCURL.php?token=" + token + "&expediente=" + expediente;

    return this.http.get<responseStudentModel>(endpoint);
  }

  getStudentByFile(file : number) : Observable<responseStudentModel> {
    
    let token = localStorage.getItem("token");
    let expediente = file;

    let endpoint = this.url + "alumnoCURL.php?token=" + token + "&expediente=" + expediente;

    return this.http.get<responseStudentModel>(endpoint);
  }
}
