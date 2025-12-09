"use client";

import { useState } from "react";

export default function EmployeeFormModal({ onAdd }) {
  const [open, setOpen] = useState(false);

  const [form, setForm] = useState({
    name: "",
    email: "",
    phone: "",
    position: "",
    salary: "",
    status: "1",
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    onAdd(form);
    setForm({
      name: "",
      email: "",
      phone: "",
      position: "",
      salary: "",
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
        Add Employee
      </button>

      {/* MODAL OVERLAY */}
      {open && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          {/* MODAL BOX */}
          <div className="bg-white w-full max-w-md rounded-lg shadow-lg animate-fadeIn">
            <form onSubmit={handleSubmit} className="modal-content">
              {/* HEADER */}
              <div className="p-4 border-b flex justify-between items-center">
                <h5 className="text-lg font-semibold">Add Employee</h5>
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
                <input
                  className="w-full p-2 border rounded"
                  placeholder="Name"
                  required
                  value={form.name}
                  onChange={(e) =>
                    setForm({ ...form, name: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Email"
                  required
                  value={form.email}
                  onChange={(e) =>
                    setForm({ ...form, email: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Phone"
                  value={form.phone}
                  onChange={(e) =>
                    setForm({ ...form, phone: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Position"
                  required
                  value={form.position}
                  onChange={(e) =>
                    setForm({ ...form, position: e.target.value })
                  }
                />

                <input
                  className="w-full p-2 border rounded"
                  placeholder="Salary"
                  required
                  value={form.salary}
                  onChange={(e) =>
                    setForm({ ...form, salary: e.target.value })
                  }
                />

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
