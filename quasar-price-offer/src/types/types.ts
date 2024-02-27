interface Offer {
  number: number;
  date: string;
  firm: string;
  itemCount: number;
  total: number;
  // Add other properties as needed
}

interface TableColumn {
  name: 'picture' | 'unit' | 'total' | string; // Define the specific types for column.name
  required?: boolean;
  label: string;
  align: 'left' | 'center' | 'right';
  field: (row: RowType) => string | number;
  format?: (val: string) => string;
  sortable?: boolean;
  style?: string;
  sort?: (a: string, b: string, rowA: RowType, rowB: RowType) => number;
}

interface RowType {
  itemId: number;
  sortOrder: number;
  productName: string;
  amount: number;
  unit: string;
  unitPrice: number;
  total: number;
  picture: string;
}

export type { Offer, TableColumn, RowType };
