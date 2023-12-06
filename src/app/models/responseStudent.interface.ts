import { studentModel } from "./student.interface";

export interface responseStudentModel extends studentModel{
    result : string;
    alumnos : studentModel[];
}