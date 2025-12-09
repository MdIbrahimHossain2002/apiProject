"use client";

import { useState } from "react";

export default function ProductForm({ employees, onAdd }) {
  const [open, setOpen] = useState(false);

  const [form, setForm] = useState({
    employee_id: "",
    name: "",
    sku: "",
    price: "",
    quantity: "",
    category: "",
    description: "",
    status: "1",
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    onAdd(form);

    // CLEAR FORM
    setForm({
      employee_id: "",
      name: "",
      sku: "",
      price: "",
      quantity: "",
      category: "",
      description: "",
      status: "1",
    });

    setOpen(false);
  };

  return (
    <>
      {/* OPEN MODAL BUTTON */}
      <button
        onClick={() => setOpen(true)}
        className="bg-blue-600 text-white px-4 py-2 rounded"
      >
        Add Product
      </button>

      {/* MODAL OVERLAY */}
      {open && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div className="bg-white w-full max-w-lg rounded-lg shadow-lg">
            <form onSubmit={handleSubmit} className="modal-content">
              {/* HEADER */}
              <div className="p-4 border-b flex justify-between items-center">
                <h5 className="text-lg font-semibold">Add Product</h5>
                <button
                  type="button"
                  onClick={() => setOpen(false)}
                  className="text-gray-600 hover:text-black"
                >
                  ✕
                </button>
              </div>

              {/* BODY */}
              <div className="p-4 space-y-3">
                {/* Employee Dropdown */}
                <select
                  required
                  className="w-full p-2 border rounded"
                  value={form.employee_id}
                  onChange={(e) =>
                    setForm({ ...form, employee_id: e.target.value })
                  }
                >
                  <option value="">Select Employee</option>
                  {employees.map((emp) => (
                    <option key={emp.id} value={emp.id}>
                      {emp.name}
                    </option>
                  ))}
                </select>

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Product Name"
                  required
                  value={form.name}
                  onChange={(e) =>
                    setForm({ ...form, name: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="SKU Code"
                  required
                  value={form.sku}
                  onChange={(e) => setForm({ ...form, sku: e.target.value })}
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Price"
                  required
                  value={form.price}
                  onChange={(e) => setForm({ ...form, price: e.target.value })}
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Quantity"
                  required
                  value={form.quantity}
                  onChange={(e) =>
                    setForm({ ...form, quantity: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Category"
                  required
                  value={form.category}
                  onChange={(e) =>
                    setForm({ ...form, category: e.target.value })
                  }
                />

                <textarea
                  className="w-full p-2 border rounded"
                  placeholder="Description"
                  value={form.description}
                  onChange={(e) =>
                    setForm({ ...form, description: e.target.value })
                  }
                ></textarea>

                <select
                  className="w-full p-2 border rounded"
                  value={form.status}
                  onChange={(e) =>
                    setForm({ ...form, status: e.target.value })
                  }
                >
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

              {/* FOOTER */}
              <div className="p-4 border-t flex justify-end">
                <button
                  type="submit"
                  className="bg-green-600 text-white px-4 py-2 rounded"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </>
  );
}
