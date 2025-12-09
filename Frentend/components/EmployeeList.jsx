"use client";

import { useState } from "react";

export default function EmployeeList({ employees, onDelete, onUpdate }) {
  const [editId, setEditId] = useState(null);
  const [form, setForm] = useState({});

  const startEdit = (emp) => {
    setEditId(emp.id);
    setForm({
      id: emp.id,
      name: emp.name,
      email: emp.email,
      phone: emp.phone ?? "",
      position: emp.position ?? "",
      salary: emp.salary ?? "",
      status: emp.status ?? "1",
    });
  };

  const saveEdit = () => {
    onUpdate(form);
    setEditId(null);
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow mt-6">
      <h2 className="text-xl font-semibold mb-4">Employee List</h2>

      {employees.length === 0 && (
        <p className="text-gray-500">No employees found.</p>
      )}

      <div className="space-y-4">
        {employees.map((emp) => (
          <div
            key={emp.id}
            className="p-4 border rounded flex flex-col gap-3 bg-gray-50"
          >
            {/* If editing this employee */}
            {editId === emp.id ? (
              <>
                <input
                  className="p-2 border rounded"
                  placeholder="Name"
                  value={form.name}
                  onChange={(e) =>
                    setForm({ ...form, name: e.target.value })
                  }
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Email"
                  value={form.email}
                  onChange={(e) =>
                    setForm({ ...form, email: e.target.value })
                  }
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Phone"
                  value={form.phone}
                  onChange={(e) =>
                    setForm({ ...form, phone: e.target.value })
                  }
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Position"
                  value={form.position}
                  onChange={(e) =>
                    setForm({ ...form, position: e.target.value })
                  }
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Salary"
                  value={form.salary}
                  onChange={(e) =>
                    setForm({ ...form, salary: e.target.value })
                  }
                />

                <select
                  className="p-2 border rounded"
                  value={form.status}
                  onChange={(e) =>
                    setForm({ ...form, status: e.target.value })
                  }
                >
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>

                {/* SAVE + CANCEL */}
                <div className="flex gap-3 mt-2">
                  <button
                    onClick={saveEdit}
                    className="bg-green-600 text-white px-4 py-1 rounded"
                  >
                    Save
                  </button>

                  <button
                    onClick={() => setEditId(null)}
                    className="bg-gray-400 text-white px-4 py-1 rounded"
                  >
                    Cancel
                  </button>
                </div>
              </>
            ) : (
              <>
                {/* VIEW MODE */}
                <div>
                  <p className="font-bold">{emp.name}</p>
                  <p className="text-sm text-gray-600">{emp.email}</p>
                  <p className="text-sm">📞 {emp.phone}</p>
                  <p className="text-sm">💼 {emp.position}</p>
                  <p className="text-sm">💰 {emp.salary}</p>
                  <p className="text-sm">
                    {emp.status == 1 ? "🟢 Active" : "🔴 Inactive"}
                  </p>
                </div>

                <div className="flex gap-3">
                  <button
                    className="bg-blue-500 text-white px-4 py-1 rounded"
                    onClick={() => startEdit(emp)}
                  >
                    Edit
                  </button>

                  <button
                    className="bg-red-500 text-white px-4 py-1 rounded"
                    onClick={() => onDelete(emp.id)}
                  >
                    Delete
                  </button>
                </div>
              </>
            )}
          </div>
        ))}
      </div>
    </div>
  );
}
