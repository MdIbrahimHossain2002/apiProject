"use client";

import { useState } from "react";

export default function ProductList({ product, onDelete, onUpdate }) {
  const [editId, setEditId] = useState(null);
  const [form, setForm] = useState({});

  const startEdit = (item) => {
    setEditId(item.id);
    setForm({
      id: item.id,
      employee_id: item.employee_id ?? "",
      name: item.name,
      sku: item.sku,
      price: item.price,
      quantity: item.quantity,
      category: item.category,
      description: item.description ?? "",
      status: item.status ?? "1",
    });
  };

  const saveEdit = () => {
    onUpdate(form);
    setEditId(null);
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow mt-6">
      <h2 className="text-xl font-semibold mb-4">Product List</h2>

      {product.length === 0 && (
        <p className="text-gray-500">No products found.</p>
      )}

      <div className="space-y-4">
        {product.map((p) => (
          <div
            key={p.id}
            className="p-4 border rounded flex flex-col gap-3 bg-gray-50"
          >
            {/* EDIT MODE */}
            {editId === p.id ? (
              <>
                <input
                  className="p-2 border rounded"
                  placeholder="Product Name"
                  value={form.name}
                  onChange={(e) => setForm({ ...form, name: e.target.value })}
                />

                <input
                  className="p-2 border rounded"
                  placeholder="SKU Code"
                  value={form.sku}
                  onChange={(e) => setForm({ ...form, sku: e.target.value })}
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Price"
                  value={form.price}
                  onChange={(e) => setForm({ ...form, price: e.target.value })}
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Quantity"
                  value={form.quantity}
                  onChange={(e) =>
                    setForm({ ...form, quantity: e.target.value })
                  }
                />

                <input
                  className="p-2 border rounded"
                  placeholder="Category"
                  value={form.category}
                  onChange={(e) =>
                    setForm({ ...form, category: e.target.value })
                  }
                />

                <textarea
                  className="p-2 border rounded"
                  placeholder="Description"
                  value={form.description}
                  onChange={(e) =>
                    setForm({ ...form, description: e.target.value })
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
                  <p className="font-bold text-lg">{p.name}</p>
                  <p className="text-sm text-gray-700">SKU: {p.sku}</p>
                  <p className="text-sm">💰 Price: {p.price}</p>
                  <p className="text-sm">📦 Quantity: {p.quantity}</p>
                  <p className="text-sm">🏷 Category: {p.category}</p>
                  <p className="text-sm">📝 {p.description}</p>
                  <p className="text-sm mt-1">
                    {p.status == 1 ? "🟢 Active" : "🔴 Inactive"}
                  </p>
                </div>

                <div className="flex gap-3 mt-2">
                  <button
                    className="bg-blue-500 text-white px-4 py-1 rounded"
                    onClick={() => startEdit(p)}
                  >
                    Edit
                  </button>

                  <button
                    className="bg-red-500 text-white px-4 py-1 rounded"
                    onClick={() => onDelete(p.id)}
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
