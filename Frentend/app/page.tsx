"use client";

import { useEffect, useState } from "react";
import EmployeeList from "@/components/EmployeeList";
import EmployeeForm from "@/components/EmployeeForm";
import ProductForm from "@/components/ProductForm";
import ProductList from "@/components/ProductList";

export default function Home() {
  const [employees, setEmployees] = useState([]);
  const [product, setProduct] = useState([]);

  // FETCH EMPLOYEES
  const loadEmployees = async () => {
    const res = await fetch("http://127.0.0.1:8000/api/employees");
    const data = await res.json();
    setEmployees(data);
  };

  useEffect(() => {
    loadEmployees();
  }, []);

  const loadProduct = async () => {
    const res = await fetch("http://127.0.0.1:8000/api/products");
    const data = await res.json();
    setProduct(data);
  };
  useEffect(() => {
    loadProduct();
  }, []);
  // ADD EMPLOYEE
  const addEmployee = async (employee) => {
    await fetch("http://127.0.0.1:8000/api/employees/store", {
      method: "POST",
      body: JSON.stringify(employee),
      headers: { "Content-Type": "application/json" },
    });
    loadEmployees();
  };


  const addProduct = async (product) => {
    await fetch("http://127.0.0.1:8000/api/products/store", {
      method: "POST",
      body: JSON.stringify(product),
      headers: { "Content-Type": "application/json" },
    });
    loadProduct();
  };
  // UPDATE EMPLOYEE
  const updateEmployee = async (employee) => {
    await fetch("http://127.0.0.1:8000/api/employees/update", {
      method: "POST",
      body: JSON.stringify(employee),
      headers: { "Content-Type": "application/json" },
    });
    loadEmployees();
  };
  
 const updateProduct = async (product) => {
    await fetch("http://127.0.0.1:8000/api/products/update", {
      method: "POST",
      body: JSON.stringify(product),
      headers: { "Content-Type": "application/json" },
    });
    loadProduct();
  };
  // DELETE EMPLOYEE
  const deleteEmployee = async (id) => {
    await fetch("http://127.0.0.1:8000/api/employees/delete", {
      method: "POST",
      body: JSON.stringify({ id }),
      headers: { "Content-Type": "application/json" },
    });
    loadEmployees();
  };

    const deleteProduct = async (id) => {
    await fetch("http://127.0.0.1:8000/api/products/delete", {
      method: "POST",
      body: JSON.stringify({ id }),
      headers: { "Content-Type": "application/json" },
    });
    loadProduct();
  };
  return (
    <div className="min-h-screen bg-zinc-100 dark:bg-black p-10">
      <h1 className="text-3xl font-bold mb-6 text-center">Employee CRUD App</h1>

      {/* CHILD COMPONENTS */}
      <EmployeeForm onAdd={addEmployee} />
      <EmployeeList
        employees={employees}
        onDelete={deleteEmployee}
        onUpdate={updateEmployee}
      />
      <ProductForm employees={employees} onAdd={addProduct} />
      <ProductList
        product={product}
        onDelete={deleteProduct}
        onUpdate={updateProduct}
      />
    </div>
  );
}
